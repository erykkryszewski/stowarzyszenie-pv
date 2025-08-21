import $ from 'jquery'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

$(document).ready(function() {
  if ($('.testimonials__slider')) {
    $('.testimonials__slider').slick({
      dots: true,
      arrows: false,
      infinite: true,
      speed: 550,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 5000,
      cssEase: 'ease-out',
      infinite: true,
      fade: true,
      responsive: [
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 1
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    })
    $(".slick-prev").text("")
    $(".slick-next").text("")
    $("ul.slick-dots > li > button").text("")
    ScrollTrigger.matchMedia({
      "(min-width: 768px)": function() {
        gsap.fromTo(
          ".testimonials__image-decorator",
          { left: 0, top: 0, opacity: 0 },
          {
            left: -30,
            top: -30,
            opacity: 1,
            duration: 1.5,
            ease: "power2.out",
            scrollTrigger: {
              trigger: ".testimonials__slider",
              start: "top 70%",
              toggleActions: "play none none none",
              // markers: true
            }
          }
        )
      },
      "(max-width: 767px)": function() {
        gsap.fromTo(
          ".testimonials__image-decorator",
          { left: 0, top: 0, opacity: 0 },
          {
            left: -15,
            top: -15,
            opacity: 1,
            duration: 1.5,
            ease: "power2.out",
            scrollTrigger: {
              trigger: ".testimonials__slider",
              start: "top 80%",
              toggleActions: "play none none none"
            }
          }
        )
      }
    })
  }
})
