/**
* @Crafted: Ronyan Alves
* @Date: 2017-10-23 15:25
* @Project: JQuery
*
**/

<!doctype html>
<html>
<meta charset='utf-8' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript' src='<?php echo sc_url_library("sys","lib_util","canvas2image.js"); ?>'></script>
<style>
    .doc {
        width: 604px;
        margin: 0 auto;
    }
    canvas {
        display: block;
        border: 2px solid #888;
    }
</style>
<body>
<div class="doc">
    <canvas width="600" height="100" id="cvs"></canvas>
    <div>
        <p>
            <button id="save" style="display:none;">save</button>
			<select id="tipo_cmp">
				<option value="base">Base Datos</option>
                <option value="archivo">Archivo</option>
			</select>
			<button id="convert">OK</button> 
            <select id="sel" style="display:none;" >
                <option value="png">png</option>
                <option value="jpeg">jpeg</option>
                <option value="bmp">bmp</option>
            </select><br/>
            <input type="hidden" value="600" id="imgW" readonly  />
            <input type="hidden" value="100" id="imgH" readonly />
        </p>

    </div>
    <div id="imgs" style='display:none'>
        
    </div>
</div>
<script>
    var canvas, ctx, bMouseIsDown = false, iLastX, iLastY,
        $save, $imgs,
        $convert, $imgW, $imgH,
        $sel;
    function init () {
        canvas = document.getElementById('cvs');
        ctx = canvas.getContext('2d');
        $save = document.getElementById('save');
        $convert = document.getElementById('convert');
        $sel = document.getElementById('sel');
        $imgs = document.getElementById('imgs');
        $imgW = document.getElementById('imgW');
        $imgH = document.getElementById('imgH');
        bind();
        draw();
    }
    function bind () {
        canvas.onmousedown = function(e) {
            bMouseIsDown = true;
            iLastX = e.clientX - canvas.offsetLeft + (window.pageXOffset||document.body.scrollLeft||document.documentElement.scrollLeft);
            iLastY = e.clientY - canvas.offsetTop + (window.pageYOffset||document.body.scrollTop||document.documentElement.scrollTop);
        }
        canvas.onmouseup = function() {
            bMouseIsDown = false;
            iLastX = -1;
            iLastY = -1;
        }
        canvas.onmousemove = function(e) {
            if (bMouseIsDown) {
                var iX = e.clientX - canvas.offsetLeft + (window.pageXOffset||document.body.scrollLeft||document.documentElement.scrollLeft);
                var iY = e.clientY - canvas.offsetTop + (window.pageYOffset||document.body.scrollTop||document.documentElement.scrollTop);
                ctx.moveTo(iLastX, iLastY);
                ctx.lineTo(iX, iY);
                ctx.stroke();
                iLastX = iX;
                iLastY = iY;
            }
        };
        
        $save.onclick = function (e) {
            var type = $sel.value,
                w = $imgW.value,
                h = $imgH.value;
            Canvas2Image.saveAsImage(canvas, w, h, type);
        }
		
		$('#tipo_cmp').change(function(){
			console.log($(this).find(':selected').val());
		})
        $convert.onclick = function (e) {
            var type = $sel.value,
                w = $imgW.value,
                h = $imgH.value;
            $imgs.appendChild(Canvas2Image.convertToImage(canvas, w, h, 'png'));
			var imgBase64 = $("#imgs > img").last().attr('src');
			imgBase64 = imgBase64.split("data:image/png;base64,");
			var dados = {
				'tipo': $('#tipo_cmp').find(':selected').val(),
				'img': imgBase64[1]
			}
			$.ajax({
				url: 'imageProcess.php',
				type: 'POST',
				dataType: 'JSON',
				data: dados
			})
			.done(function(ret){
				window.location='showImage.php?id='+ret;
			})
			.fail(function(hxr,textStatus){
				alert(textStatus);
				console.log(hxr.responseText);
			});
        }
    }
	function draw () {
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, 600, 400);
    }
	onload = init;
</script>
</body>
</html>
