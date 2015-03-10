/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var clsCut = (function (){
    
    var rect;
    function lestCut(cutBtn, endBtn, idImg, idContainer) // funcion para cortar
    {
        cutBtn = "#" + cutBtn;
        endBtn = "#" + endBtn;
        idImg = "#" + idImg;
        
        $(cutBtn).fadeOut();     //ocultar boton de recortar
        $(endBtn).fadeIn();
        $(idImg).fadeOut(); //oculta la Imagen
        var url = $(idImg).attr("src");
        var img = new Image();
        img.src = url;
        img.onload = function (){
            var imgWidth = this.widget;
            var imgHeight = this.height;
            var stage = new Kinetic.Stage({
                container : idContainer,
                width: imgWidth,
                height: imgHeight
            });
            var layer = new Kinectic.Layer();
            var image = new Kinetic.Image({
                x: 0,
                y: 0,
                image : this
            });
            layer.add(image);
            stage.add(layer);
            drawCircles(stage, layer,cutBtn,endBtn);  //dibuja los circulas para limitar el corte
            
        }
        
    }
    
    function drawCircles(stage,layer,cutBtn,endBtn){
        var imgW, imgH;
        
        var circle = new Kinetic.Circle({
            x: 20,
            y: 20,
            radius: 20,
            fill: "black",
            strake: "white",
            draggable: true
        });
        
        var circle4 = new Kinetic.Circle({
            x: stage.getWidth() - 20,
            y: stage.getHeight() - 20,
            radius: 20,
            fill: "black",
            strake: "white",
            draggable: true
        });
        var shapes = [circle,circle4];
        
        if(!rect){
            imgW = shapes[0].getX() - shapes[1].getX();
            imgH = shapes[0].getY() - shapes[1].getY();
            rect = new Kinetic.Rect({
                x: shapes[0].getX(),
                y: shapes[0].getY(),
                width: imgW,
                height: imgH,
                fill: "rgba(0,0,0,0.5)"
            });
            layer.add(rect);
            layer.draw();
        }    
         for (var i = 0; i< shapes.length;i++){
                shapes[i].on("dragend",function (){
                    if(rect){
                        layer.remove(rect);
                    }
                     imgW = shapes[0].getX() - shapes[1].getX();
                     imgH = shapes[0].getY() - shapes[1].getY();
                    rect = new Kinetic.Rect({
                        x: shapes[0].getX(),
                        y: shapes[0].getY(),
                        width: imgW,
                        height: imgH,
                        fill: "rgba(0,0,0,0.5)"
                    });
                    layer.add(rect);
                    layer.draw();
                });
         }
         $(endBtn).on("click",function (){
             layer.remove(circle);
             layer.remove(circle4);
             layer.remove(rect);
             layer.draw();
             var miCanvas = document.getElementsByName("canvas");
             var ctx = miCanvas[2].getContect("2d");
             var datosDeLaImagen = ctx.getImageData(rect.getX(), rect.getY(), -imgW,-imgW);
             var canvasFinal = miCanvas[3];
             var ctx2 = canvasFinal.getContext("2d");
             canvasFinal.height = datosDeLaImagen.height;
             canvasFinal.width = datosDeLaImagen.width;
             ctx2.putImageData(datosDeLaImagen,0,0);
              var dataURL = canvasFinal.toDataURL();
              window.open(dataURL);
         });
         layer.add(circle);
         layer.add(circle4);
         stage.add(layer);
}
    return {
        lestCut : lestCut
    }   
})();