// wait until DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM loaded");

    gsap.registerPlugin(ScrollTrigger);

    // Function to check if we're on mobile
    const isMobile = () => window.innerWidth < 945;

    // Header animation
    const headerAnimation = gsap.to(".header", {
        padding: "0px 20px",
        paddingTop: "2.25rem",
        duration: 0.5,
        boxShadow: "0px 4px 8px rgba(0, 0, 0, 0.15)",
        backgroundColor: "#171614",
        ease: "power1.out",
        scrollTrigger: {
            trigger: "body",
            start: "top top",
            end: "50 top",
            onEnter: () => {
                const header = document.querySelector('.headerGroup');
                header.classList.add('scrolled');
            },
            onLeaveBack: () => {
                const header = document.querySelector('.headerGroup');
                header.classList.remove('scrolled');
            },
            toggleActions: "play none none reverse",
        }
    });

    // Update animation on window resize
    window.addEventListener('resize', () => {
        // The width will be handled by CSS media queries
        // We only need to invalidate the ScrollTrigger to ensure proper positioning
        ScrollTrigger.refresh();
    });

    //appearAnimation animation main title h1
    gsap.fromTo(".appearAnimation", {
        y: 200,
    },{
        autoAlpha: 1, // Passe de `visibility: hidden` à `visible` et anime l'opacité
        y: 0,
        duration: 1,
        ease: "power1.out"
    });

    //appearAnimation animation main title h1
    gsap.fromTo(".appearAnimationScroll", {
        y: 200,
    },{
        autoAlpha: 1, // Passe de `visibility: hidden` à `visible` et anime l'opacité
        y: 0,
        duration: 1,
        ease: "power1.out",
        scrollTrigger: {
            trigger: ".appearAnimationScroll",
            toggleActions: "play none none none", // Play the animation when it enters the viewport
        }
    });


    //body background color change animation section .colorChangeTrigger, body css animation
    const triggerElement = document.querySelector(".colorChangeTrigger");
    if (triggerElement) {
        gsap.to("body", { // Anime à la fois le body et le cursor
            backgroundColor: "var(--wp--preset--color--rouge-clair)", // Couleur de fond du body
            color: "var(--wp--preset--color--beige)", // Texte en beige
            ease: "power1.inOut",
            scrollTrigger: {
                trigger: triggerElement,
                start: "top center",
                end: "bottom center",
                toggleActions: "play reverse play reverse"
            }
        });
    
        gsap.to(".cursor", { 
            backgroundColor: "var(--wp--preset--color--beige)", // Change la couleur du curseur en beige
            ease: "power1.inOut",
            scrollTrigger: {
                trigger: triggerElement,
                start: "top center",
                end: "bottom center",
                toggleActions: "play reverse play reverse"
            }
        });
    }
    









    // barba.js transitions
        // Initialise Barba
        barba.init({
            transitions: [
                {
                    name: "fade",
                    leave(data) {
                        return gsap.to(data.current.container, {
                            opacity: 0,
                            duration: 0.5
                        });
                    },
                    enter(data) {
                        return gsap.from(data.next.container, {
                            opacity: 0,
                            duration: 0.5
                        });
                    }
                }
            ]
        });
    
});
