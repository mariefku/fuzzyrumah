@extends('layout.app')

@section('content')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCzX9p40w9AMetlyG_qUi_9rw0ifj9rhk&libraries=places,drawing,geometry&.js"></script>
<script type="text/javascript" src=" {{ asset('js/maps.google.polygon.containsLatLng.js') }} "></script>
<style >

html, body
  {
      padding: 0;
      margin: 0;
      height: 100%;
  }
  .map{height:300px;}

</style>

<form class="form-horizontal" action="add" method="post">
  {{ csrf_field() }}
    <div class="form-group">
      <label for="nama_area" class="control-label">nama_area</label>
      <div class="">
        <input type="text" class="form-control" id="nama_area" placeholder="Judul Lokasi" name="nama_area" value="{{ old('nama_lokasi') }}">
      </div>
    </div>
    <div class="form-group">
      <label for="harga_area" class="control-label">harga_area</label>
      <div class="">
        <input type="text" class="form-control" id="harga_area" placeholder="Judul Lokasi" name="harga_area" value="{{ old('nama_lokasi') }}">
      </div>
    </div>
    <div class="form-group">
      <input type="text" id="area_lokasi" name="area_lokasi">
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Simpan</button>
        </div>
    </div>
</form>

<div class="map" id="map_in"></div>
<div style="text-align:center">
    <a href="http://jsfiddle.net/doktormolle/EdZk4/">[source]</a><input id="clear_shapes" value="clear shapes"    type="button"  />
  <input id="save_encoded" value="save encoded(IO.IN(shapes,true))"    type="button" />
  <input id="save_raw"     value="save raw(IO.IN(shapes,false))"        type="button" />
  <input id="data"         value=""                style="width:100%" readonly/>
  <input id="data_encode"        value=""                style="width:100%" readonly/>
  <input id="restore"      value="restore(IO.OUT(array,map))"         type="button" />
  <input id="restoreku"      value="restoreku"         type="button" />
</div>
<div class="map" id="map_out"></div>

<script>
function initialize()
{   
    var goo             = google.maps,
        map_in          = new goo.Map(document.getElementById('map_in'), 
                                      { zoom: 12, 
                                        center: new goo.LatLng(32.344, 51.048)
                                      }),
        map_out         = new goo.Map(document.getElementById('map_out'), 
                                      { zoom: 12, 
                                        center: new goo.LatLng(32.344, 51.048)
                                      }),
        shapes          = [],
        selected_shape  = null,
        drawman         = new goo.drawing.DrawingManager({map:map_in}),
        byId            = function(s){return document.getElementById(s)},
        clearSelection  = function(){
                            if(selected_shape){
                              selected_shape.set((selected_shape.type
                                                  ===
                                                  google.maps.drawing.OverlayType.MARKER
                                                 )?'draggable':'editable',false);
                              selected_shape = null;
                            }
                          },
        setSelection    = function(shape){
                            clearSelection();
                            selected_shape=shape;
                            
                              selected_shape.set((selected_shape.type
                                                  ===
                                                  google.maps.drawing.OverlayType.MARKER
                                                 )?'draggable':'editable',true);
                              
                          },
        clearShapes     = function(){
                            for(var i=0;i<shapes.length;++i){
                              shapes[i].setMap(null);
                            }
                            shapes=[];
                          };
    map_in.bindTo('center',map_out,'center');
    map_in.bindTo('zoom',map_out,'zoom');

    goo.event.addListener(drawman, 'overlaycomplete', function(e) {
        var shape   = e.overlay;
        shape.type  = e.type;
        goo.event.addListener(shape, 'click', function() {
          setSelection(this);
        });
        setSelection(shape);
        shapes.push(shape);
      });

    goo.event.addListener(map_in, 'click',clearSelection);
    goo.event.addDomListener(byId('clear_shapes'), 'click', clearShapes);
    goo.event.addDomListener(byId('save_encoded'), 'click', function(){
      var data=IO.IN(shapes,true);byId('data').value=JSON.stringify(data);});
    goo.event.addDomListener(byId('save_raw'), 'click', function(){
      var data=IO.IN(shapes,false);byId('data').value=JSON.stringify(data);});
    goo.event.addDomListener(byId('restore'), 'click', function(){
      if(this.shapes){
        for(var i=0;i<this.shapes.length;++i){
              this.shapes[i].setMap(null);
        }
      }

      this.shapes=IO.OUT(JSON.parse(byId('data').value),map_out);
      console.log(byId('data').value+' '+byId('data').value.length);
    });

    goo.event.addDomListener(byId('restoreku'), 'click', function(){
      if(this.shapes){
        for(var i=0;i<this.shapes.length;++i){
              this.shapes[i].setMap(null);
        }
      }
      
      this.shapes=draws(JSON.parse(byId('data').value),map_out);
    });
    
}

function encodePolygon(polygon)
    {
        //This variable gets all bounds of polygon.

        var path = polygon.getPath();

        var encodeString = google.maps.geometry.encoding.encodePath(path);

        return encodeString;
        /* store encodeString in database */
}

var IO={
  //returns array with storable google.maps.Overlay-definitions
  IN:function(arr,//array with google.maps.Overlays
              encoded//boolean indicating whether pathes should be stored encoded
              ){
      var shapes     = [],
          goo=google.maps,
          shape,tmp;
      
      for(var i = 0; i < arr.length; i++)
      {   
        shape=arr[i];
        tmp={type:this.t_(shape.type),id:shape.id||null};
        
        
        switch(tmp.type){
           case 'CIRCLE':
              tmp.radius=shape.getRadius();
              tmp.geometry=this.p_(shape.getCenter());
            break;
           case 'MARKER': 
              tmp.geometry=this.p_(shape.getPosition());   
            break;  
           case 'RECTANGLE': 
              tmp.geometry=this.b_(shape.getBounds()); 
             break;   
           case 'POLYLINE': 
              tmp.geometry=this.l_(shape.getPath(),encoded);
             break;   
           case 'POLYGON': 
              tmp.geometry=this.m_(shape.getPaths(),encoded);
              jQuery('#data_encode').val(encodePolygon(shape));
              alert(shape);
             break;   
       }
       shapes.push(tmp);
    }

    return shapes;
  },
  //returns array with google.maps.Overlays
  OUT:function(arr,//array containg the stored shape-definitions
               map//map where to draw the shapes
               ){
      var shapes     = [],
          goo=google.maps,
          map=map||null,
          shape,tmp;
      
      for(var i = 0; i < arr.length; i++)
      {   
        shape=arr[i];       
        
        switch(shape.type){
           case 'CIRCLE':
              tmp=new goo.Circle({radius:Number(shape.radius),center:this.pp_.apply(this,shape.geometry)});
            break;
           case 'MARKER': 
              tmp=new goo.Marker({position:this.pp_.apply(this,shape.geometry)});
            break;  
           case 'RECTANGLE': 
              tmp=new goo.Rectangle({bounds:this.bb_.apply(this,shape.geometry)});
             break;   
           case 'POLYLINE': 
              tmp=new goo.Polyline({path:this.ll_(shape.geometry)});
             break;   
           case 'POLYGON': 
              tmp=new goo.Polygon({paths:this.mm_(shape.geometry)});
              console.log(tmp);
             break;   
       }
       tmp.setValues({map:map,id:shape.id})
       shapes.push(tmp);
    }
    return shapes;
  },
  l_:function(path,e){
    path=(path.getArray)?path.getArray():path;
    if(e){
      return google.maps.geometry.encoding.encodePath(path);
    }else{
      var r=[];
      for(var i=0;i<path.length;++i){
        r.push(this.p_(path[i]));
      }
      return r;
    }
  },
  ll_:function(path){
    if(typeof path==='string'){
      return google.maps.geometry.encoding.decodePath(path);
    }
    else{
      var r=[];
      for(var i=0;i<path.length;++i){
        r.push(this.pp_.apply(this,path[i]));
      }
      return r;
    }
  },

  m_:function(paths,e){
    var r=[];
    paths=(paths.getArray)?paths.getArray():paths;
    for(var i=0;i<paths.length;++i){
        r.push(this.l_(paths[i],e));
      }
     return r;
  },
  mm_:function(paths){
    var r=[];
    for(var i=0;i<paths.length;++i){
        r.push(this.ll_.call(this,paths[i]));
        
      }
     return r;
  },
  p_:function(latLng){
    return([latLng.lat(),latLng.lng()]);
  },
  pp_:function(lat,lng){
    return new google.maps.LatLng(lat,lng);
  },
  b_:function(bounds){
    return([this.p_(bounds.getSouthWest()),
            this.p_(bounds.getNorthEast())]);
  },
  bb_:function(sw,ne){
    return new google.maps.LatLngBounds(this.pp_.apply(this,sw),
                                        this.pp_.apply(this,ne));
  },
  t_:function(s){
    var t=['CIRCLE','MARKER','RECTANGLE','POLYLINE','POLYGON'];
    for(var i=0;i<t.length;++i){
       if(s===google.maps.drawing.OverlayType[t[i]]){
         return t[i];
       }
    }
  }
  
}

function draw(arr,map){

      var shapes     = [],
          map=map||null,
          shape,tmp;
      
      for(var i = 0; i < arr.length; i++)
      {   
        shape=arr[i];


        switch(shape.type){
           case 'CIRCLE':
              tmp=new goo.Circle({radius:Number(shape.radius),center:this.pp_.apply(this,shape.geometry)});
            break;
           case 'MARKER': 
              tmp=new goo.Marker({position:this.pp_.apply(this,shape.geometry)});
            break;  
           case 'RECTANGLE': 
              tmp=new goo.Rectangle({bounds:this.bb_.apply(this,shape.geometry)});
             break;   
           case 'POLYLINE': 
              tmp=new goo.Polyline({path:this.ll_(shape.geometry)});
             break;   
           case 'POLYGON': 
              tmp=new google.maps.Polygon({paths: google.maps.geometry.encoding.decodePath(shape.geometry)});
              console.log('ini TMP '+tmp);
             break;   
       }


        tmp.setValues({map:map,id:shape.id});
        console.log('ini TMP set values '+tmp.setValues({map:map,id:shape.id}));
        shapes.push(tmp);
        console.log('ini shapes.push '+shapes.push(tmp));
      }
      console.log('ini shapes '+shapes);
      return shapes;
  };

  function draws(arr,//array containg the stored shape-definitions
               map//map where to draw the shapes
               ){
      var shapes     = [],
          goo=google.maps,
          map=map||null,
          shape,tmp;
      
      for(var i = 0; i < arr.length; i++)
      {   
        shape=arr[i];       
        
        switch(shape.type){
           case 'CIRCLE':
              tmp=new goo.Circle({radius:Number(shape.radius),center:this.pp_.apply(this,shape.geometry)});
            break;
           case 'MARKER': 
              tmp=new goo.Marker({position:this.pp_.apply(this,shape.geometry)});
            break;  
           case 'RECTANGLE': 
              tmp=new goo.Rectangle({bounds:this.bb_.apply(this,shape.geometry)});
             break;   
           case 'POLYLINE': 
              tmp=new goo.Polyline({path:this.ll_(shape.geometry)});
             break;   
           case 'POLYGON': 
              var path=google.maps.geometry.encoding.decodePath(shape.geometry);
              tmp=new goo.Polygon({paths:path});
              console.log(tmp);
             break;   
       }
       tmp.setValues({map:map,id:shape.id})
       shapes.push(tmp);
    }
    return shapes;
  }

google.maps.event.addDomListener(window, 'load', initialize);

</script>

@endsection