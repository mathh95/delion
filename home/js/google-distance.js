$(document).on("click", "#submit", function(){
    getDistance();
 });


 function getDistance() {
     
     var origin = $("#origin").val();
     var destination = $("#destination").val();

     var service = new google.maps.DistanceMatrixService;
     service.getDistanceMatrix({
         origins: [origin],
         destinations: [destination],
         travelMode: 'DRIVING',
         unitSystem: google.maps.UnitSystem.METRIC,
         avoidHighways: false,
         avoidTolls: false
     }, function (response, status) {
         
         console.log(response);
         
         var status = response.rows[0].elements[0].status;
         
         if (status !== 'OK') {
             alert('Error was: ' + status);
         } else {
         
             var originList = response.originAddresses;
             var destinationList = response.destinationAddresses;

             for (var i = 0; i < originList.length; i++) {

                 var results = response.rows[i].elements;
                 
                 for (var j = 0; j < results.length; j++) {
                    
                     $("#result p").append(originList[i] + ' to ' + destinationList[j] +
                         ': ' + results[j].distance.text + ' in ' +
                         results[j].duration.text + '<br>');

                     //getTempoPreparo("cardapio") * multiplicadorPedidosEmEspera
                     //minutos
                     var tempo_preparo = "20" * 1;//sem pedidos, 1.1
                     //(dist m * valor base/km) / 1000
                     var valor_entrega = (results[j].distance.value * 2) / 1000; 
                     $("#result p").append("Custo!!! -> "+ valor_entrega);
                                       
                 }
             }
         }
     });
 }