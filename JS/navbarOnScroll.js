$(() => {
    const nav = $('nav');
    const menu = $('#menu ul');
    const ecoRide = $('.eco-ride');
    const menuToggle = $('#menu-toggle');
    let lastScrollTop = 0;
    const scrollThreshold = 20;
    let navIsTransitioning = false;

    // Détecter quand le nav commence et termine sa transition
    nav.on('transitionstart', () => {
        navIsTransitioning = true;
    });

    nav.on('transitionend', () => {
        navIsTransitioning = false;
    });

    $(window).on('scroll', () => {
        const windowTop = $(window).scrollTop();

        if (windowTop > 100) {
            nav.addClass('navShadow');

        } else {
            nav.removeClass('navShadow');
            ecoRide.addClass('show');
        }

        // Fermer le menu si on scroll vers le bas
        if (menu.hasClass('showMenu') && windowTop - lastScrollTop > scrollThreshold) {
            menu.removeClass('showMenu');
            menuToggle.removeClass('closeMenu');
        }

        lastScrollTop = windowTop;
    });

    menuToggle.on('click', () => {
        // Si la nav est en train de changer de taille, attendre la fin de la transition
        if (navIsTransitioning) {
            nav.one('transitionend', () => {
                toggleMenu();
            });
        } else {
            toggleMenu();
        }
    });

    const toggleMenu = () => {
        menuToggle.toggleClass('closeMenu');
        menu.toggleClass('showMenu');
    };

    $('#menu li').on('click', () => {
        menu.removeClass('showMenu');
        menuToggle.removeClass('closeMenu');
    });
});
