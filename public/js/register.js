$(document).ready(() => {
    $("#img").on('change', (evt) => {
        var file = evt.target.files; // FileList object
        var f = file[0];
        // Only process image files.
        if (!f.type.match('image.*')) {
            alert("Image only please....");
        }
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                var image = "<img title='" + theFile.name + "' src='" + e.target.result + "'><img>";
                if ($("#output").html()) {
                    TweenLite.to("#output", 1, {left: "-2000px", ease:Power2.easeInOut ,onComplete: function () {
                            $("#output").css({"left":0, "opacity":0});
                            $("#output").html(image);
                            TweenLite.to("#output", 1, {opacity:1, ease:Power2.easeInOut});
                        }});
                } else {
                    $("#output").html(image);
                    TweenLite.to("#output", 1, {width:"50%", ease:Power2.easeInOut});
                }
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    })
    // function handleFileSelect(evt) {
    //     var file = evt.target.files; // FileList object
    //     var f = file[0];
    //     // Only process image files.
    //     if (!f.type.match('image.*')) {
    //         alert("Image only please....");
    //     }
    //     var reader = new FileReader();
    //     // Closure to capture the file information.
    //     reader.onload = (function(theFile) {
    //         return function(e) {
    //             // Render thumbnail.
    //             var span = document.createElement('span');
    //             span.innerHTML = ['<img class="thumb" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
    //             document.getElementById('output').insertBefore(span, null);
    //         };
    //     })(f);
    //     // Read in the image file as a data URL.
    //     reader.readAsDataURL(f);
    // }
    // document.getElementById('file').addEventListener('change', handleFileSelect, false);
});