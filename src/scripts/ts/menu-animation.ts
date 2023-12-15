import { Events } from "./events";

const burgerMenu: Element | null = document.querySelector('.burger');

const menuAnimation = (): void => {
    const menu: Element | null = document.querySelector('.links');
    const burgerLines: NodeListOf<Element> = document.querySelectorAll('.line');

    if(menu?.classList.contains('animate-menu-slide-in')) {
        burgerLines[0].classList.remove('animate-top-line-active');
        burgerLines[2].classList.remove('animate-bottom-line-active');
        menu?.classList.remove('animate-menu-slide-in');
        menu?.classList.add('animate-menu-slide-out');
    }
    else {
        burgerLines[0].classList.add('animate-top-line-active');
        burgerLines[2].classList.add('animate-bottom-line-active');
        menu?.classList.remove('animate-menu-slide-out');
        menu?.classList.add('animate-menu-slide-in');
    }

    burgerLines[1].classList.toggle('invisible');
}

if(burgerMenu) burgerMenu.addEventListener(Events.CLICK, menuAnimation);