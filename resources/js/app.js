
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"
window.addEventListener('toast', event => {
                    Toastify({
                        text: event.detail.message,
                        duration: 3000,
                        gravity: "top", // "top" o "bottom"
                        position: "right", // "left", "center" o "right"
                        backgroundColor: "#4CAF50",
                        close: true
                    }).showToast();
                });

