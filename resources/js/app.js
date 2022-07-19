import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

window.Echo.private("App.Models.User." + userId).notification((data) => {
    // Increment count notification on nav
    let notification_count = document.getElementById("notification_count");
    let count = parseInt(notification_count.innerText);
    notification_count.innerText = count + 1;

    $("#notification-list").prepend(
        `<li>
            <a href="/user/notification/${data.id}/read"
                class="w-full flex justify-between gap-4 p-4 bg-gray-200 rounded border border-gray-300 overflow-hidden">
                    <div>
                        ${data.body}
                    </div>    
                    <div class="text-xs self-end">
                        now
                    </div>
            </a>
        </li>`
    );

    notification_sound.play();
});
