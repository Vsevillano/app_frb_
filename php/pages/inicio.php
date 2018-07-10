<?php

?>

<h1>Frente Rojiblanco de Azuaga</h1>
<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem doloremque exercitationem eos officiis necessitatibus et dicta quas placeat inventore repudiandae totam, accusamus cupiditate atque unde dolorem illo architecto. A, laudantium.</p>

    <script>
        jQuery(document).ready(function ($) {
            //Reference https://www.jssor.com/development/tip-make-responsive-slider.html

            var options = {
                $AutoPlay: 1,                                    //[Optional] Auto play or not, to enable slideshow, this option must be set to greater than 0. Default value is 0. 0: no auto play, 1: continuously, 2: stop at last slide, 4: stop on click, 8: stop on user navigation (by arrow/bullet/thumbnail/drag/arrow key navigation)
                $DragOrientation: 3                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0),
            };

            var jssor_slider1 = new $JssorSlider$('slider1_container', options);
            /*#region responsive code begin*/
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {

                //reserve blank width for margin+padding: margin+padding-left (10) + margin+padding-right (10)
                var paddingWidth = 20;

                //minimum width should reserve for text
                var minReserveWidth = 150;

                var parentElement = jssor_slider1.$Elmt.parentNode;

                //evaluate parent container width
                var parentWidth = parentElement.clientWidth;

                if (parentWidth) {

                    //exclude blank width
                    var availableWidth = parentWidth - paddingWidth;

                    //calculate slider width as 70% of available width
                    var sliderWidth = availableWidth * 0.7;

                    //slider width is maximum 600
                    sliderWidth = Math.min(sliderWidth, 600);

                    //slider width is minimum 200
                    sliderWidth = Math.max(sliderWidth, 200);

                    //evaluate free width for text, if the width is less than minReserveWidth then fill parent container
                    if (availableWidth - sliderWidth < minReserveWidth) {

                        //set slider width to available width
                        sliderWidth = availableWidth;

                        //slider width is minimum 200
                        sliderWidth = Math.max(sliderWidth, 200);
                    }

                    jssor_slider1.$ScaleWidth(sliderWidth);
                }
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }

            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        });
    </script>
    <div style="display: flex; margin: 20px auto 0 auto; justify-content: center;padding: 10px 5px 5px 10px; width: 90%; max-width:940px; min-width: 240px; border: 1px solid #ccc; background-color: #fff; box-shadow: 2px 2px 10px 2px #dddddd; -webkit-box-shadow: 0px 0px 5px 0px #dddddd; font-size: .8em; line-height: 1.5em;">
        <!-- Jssor Slider Begin -->
        
        <div id="slider1_container" style="position: relative; margin: 0px 5px 5px 0px; float: left; top: 0px; left: 0px; width: 600px;
            height: 300px; overflow: hidden;">
            <!-- Slides Container -->
            <div data-u="slides" style="position: absolute; left: 0px; top: 0px; width: 600px; height: 300px;
                overflow: hidden;">
                <div><img data-u="image" src="images/slide1.jpg" /></div>
                <div><img data-u="image" src="images/slide2.jpg" /></div>
                <div><img data-u="image" src="images/slide3.jpg" /></div>
                <div><img data-u="image" src="images/slide4.jpg" /></div>
            </div>
        </div>
        <!-- Jssor Slider End -->
        
    </div>

    <?php  print_r($_SESSION['login']); ?>