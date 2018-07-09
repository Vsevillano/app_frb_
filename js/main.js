const sliderResponsive = (element, delay) => {
    const slider = document.getElementById(element),
      containerImages = slider.firstElementChild,
      slides = [...slider.querySelectorAll(".slider__item")],
      prevButton = slider.querySelector(".slider__button--left"),
      nextButton = slider.querySelector(".slider__button--right"),
      controls = [...slider.children[1].children[0].children],
      length = slider.querySelectorAll(".slider__item").length;
  
    containerImages.style.width = `${100 * length}%`;
  
    slides.map(slide => {
      slide.style.backgroundImage = `url("${slide.dataset.bg}")`;
      slide.innerHTML = `<div class="slider__caption">${
        slide.dataset.caption
      }</div>`;
    });
  
    animateSlider(
      slider,
      containerImages,
      slides,
      prevButton,
      nextButton,
      controls,
      length,
      delay
    );
  };
  
  const animateSlider = (
    slider,
    containerImages,
    slides,
    prevButton,
    nextButton,
    controls,
    length,
    delay
  ) => {
    let i = 0,
      interval;
  
    const autoSlide = () => {
      interval = setInterval(() => {
        i++;
        translate(i, containerImages, length, controls);
      }, delay);
    };
    autoSlide();
  
    const clearInterv = interval => {
      clearInterval(interval);
      autoSlide();
    };
  
    window.addEventListener("keydown", e => {
      if (e.key === "ArrowLeft") prevButton.click();
      if (e.key === "ArrowRight") nextButton.click();
    });
  
    slider.addEventListener("click", e => {
      let target = e.target;
      if (target.classList.contains("slider__button--left")) {
        i--;
        i = i < 0 ? length - 1 : i;
      } else if (target.classList.contains("slider__button--right")) {
        i++;
        i = i % length;
      } else if (target.classList.contains("slider__controls__circle")) {
        i = [...e.target.parentNode.children].indexOf(e.target);
      }
      translate(i, containerImages, length, controls);
      clearInterv(interval);
    });
  };
  
  const translate = (i, containerImages, length, controls) => {
    let xMove;
    i = i % length;
    xMove = 100 / length * i;
    containerImages.style.transform = `translate3d(-${xMove}%,0,0)`;
    changeControls(i, controls);
  };
  
  const changeControls = (i, controls) => {
    controls.forEach(control => {
      control.classList.remove("active");
    });
    controls[i].classList.add("active");
  };
  
  sliderResponsive("slider", 3000);
  