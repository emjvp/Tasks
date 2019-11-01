var videos = [];
$(document).ready(function(){
   
  
    $("#carousel_container").carousel({
        pause : 5000,
        quantity : 6,
        sizes : {
            '900' : 3,
            '500' : 1
        }
    });
    $(".banner-video-youtube").each(function(){
        console.log($(this).attr("data-video"));
        var datavideo = $(this).attr("data-video");
        var idvideo = $(this).attr("id");
        var playerDefaults = {autoplay: 0, autohide: 1, modestbranding: 0, rel: 0, showinfo: 0, controls: 0, disablekb: 1, enablejsapi: 0, iv_load_policy: 3};
        var video = {'videoId':datavideo, 'suggestedQuality': 'hd720'};
        videos[videos.length] = new YT.Player(idvideo,{ 'videoId':datavideo, playerVars: playerDefaults,events: {
          'onReady': onAutoPlay,
          'onStateChange': onFinish
        }});
    });
    function onAutoPlay(event){
        event.target.playVideo();
        event.target.mute();
    }
    function onFinish(event) {        
        if(event.data === 0) {            
            event.target.playVideo();
        }
    }

        
  function alturaventana(){
    var height = $(window).height();
    console.log(height);
    $(".fondo-imagen").css("height",height);
}
alturaventana();
  $(".paginacion-content a").on("click",function(){
    var pagina = $(this).attr("data-page");
    $("#pageactual").val(pagina);
    $(".paginacontet").stop().hide();
    $("#pagina"+pagina).stop().show();
    $(".paginacion-content a").removeClass("active");
    $(this).addClass("active");
  });

  $('.izquierda').on("click", function(){
    var pagina = parseInt($("#pageactual").val())-1;
    if(pagina > 1)
    {
      
      $(".paginacontet").stop().hide();
      $("#pagina"+pagina).stop().show();
      $("#pageactual").val(pagina);
      $(".paginacion-content a").removeClass("active");
      $(".paginacion-content a[data-page='"+pagina+"']").addClass("active");
      $(".paginacontet").stop().hide();
      $("#pagina"+(pagina-1)).stop().show();
    }else if(pagina == 1){
      $("#pagina1").css("display","block");
      $("#pagina2").css("display","none");
      $(".paginacion-content a").removeClass("active");
      $(".paginacion-content a[data-page='"+pagina+"']").addClass("active");
      
    }

  $('.derecha').on("click", function(){
    var pagina = parseInt($("#pageactual").val())+1;
    var totalpages = parseInt($("#totalpages").val());
    if(pagina<=totalpages)
    {
      $(".paginacontet").stop().hide();
      $("#pagina"+pagina).stop().show();
      $("#pageactual").val(pagina);
      $(".paginacion-content a").removeClass("active");
      $(".paginacion-content a[data-page='"+pagina+"']").addClass("active");
    }
  });
    
    
}); 
  $("header .header-content .menu-responsive ul li").on("click",function(){
    $(this).children("ul li > ul").show();
  });
});
var map;
    var longitude = 0;
    var latitude = 0;
    var icon = '';
    var point = false;
    var zoom = 10;
    function setValuesMap(longitud,latitud,punto,zoomm,icono){
        longitude = longitud;
        latitude = latitud;
        if(punto){
            point = punto;
        }
        if(zoomm){
            zoom = zoomm;
        }
        if(icono){
            icon = icono
        }
    }
    function initializeMap() {
        var mapOptions = {
            zoom:parseInt(zoom),
            center: new google.maps.LatLng(longitude,latitude)
        };
        // Place a draggable marker on the map
         // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        var styledMapType = new google.maps.StyledMapType(
            [
                {
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#242f3e"
                      }
                    ]
                  },
                  {
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#746855"
                      }
                    ]
                  },
                  {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                      {
                        "color": "#242f3e"
                      }
                    ]
                  },
                  {
                    "featureType": "administrative.locality",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#d59563"
                      }
                    ]
                  },
                  {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#d59563"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#263c3f"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#6b9a76"
                      }
                    ]
                  },
                  {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#38414e"
                      }
                    ]
                  },
                  {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": [
                      {
                        "color": "#212a37"
                      }
                    ]
                  },
                  {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#9ca5b3"
                      }
                    ]
                  },
                  {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#746855"
                      }
                    ]
                  },
                  {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                      {
                        "color": "#1f2835"
                      }
                    ]
                  },
                  {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#f3d19c"
                      }
                    ]
                  },
                  {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#2f3948"
                      }
                    ]
                  },
                  {
                    "featureType": "transit.station",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#d59563"
                      }
                    ]
                  },
                  {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#17263c"
                      }
                    ]
                  },
                  {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#515c6d"
                      }
                    ]
                  },
                  {
                    "featureType": "water",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                      {
                        "color": "#17263c"
                      }
                    ]
                  }
            ],
            {name: 'Styled Map'});

        // Create a map object, and include the MapTypeId to add
        // to the map type control.
        map = new google.maps.Map(document.getElementById('map'),mapOptions,{
            mapTypeControlOptions: {
                mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                        'styled_map']
              }
        });
        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
        if(point == true){
            var marker = new google.maps.Marker({
                position:new google.maps.LatLng(longitude,latitude),
                map: map,
                icon:icon,
                title: 'Info'
            });
        }
        map.setCenter(new google.maps.LatLng(longitude,latitude));
        
    }
  function ShowHide(data){
  
    if (parseInt(data) == 1){
      $("#quienes").hide();
      $("#contacto").show();
      $("#btn-contacto a").addClass("activo");
      $("#btn-quienes a").removeClass("activo");
    } else if(parseInt(data) == 2){
      $("#btn-contacto a").removeClass("activo");
      $("#btn-quienes a" ).addClass("activo");
      $("#quienes").show();
      $("#contacto").hide();
    }

  }
  function menu(){
    if($(".menu-responsive").is(':visible')){
        $(".menu-responsive").stop().slideUp(500);
    }else{
        $(".menu-responsive").stop().slideDown(500);
    }   
}
function menuinterno(){
  if($(".menu-interno").is(':visible')){
    $(".menu-interno").stop().slideUp(500);

}
}