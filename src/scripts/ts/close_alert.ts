import { Events } from "./events";

window.addEventListener(Events.LOAD, () => {
    const closeAlertBtn = document.querySelector('.close-alert-btn');
    
    const closeAlert = (): void => {
        const alertBox = document.querySelector('.alert-box');
        if(alertBox) alertBox.remove();
    }
    
    if(closeAlertBtn) closeAlertBtn.addEventListener(Events.CLICK, closeAlert);
});
