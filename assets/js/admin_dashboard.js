        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
        document.getElementById("cross").addEventListener("click",function() {
            document.getElementById("sidebar").classList.remove("active");
        })

        function toggleDropdown(menuId) {
            let menu = document.getElementById(menuId);
            menu.classList.toggle("show");

            // Rotate arrow
            menu.parentElement.classList.toggle("active");
        }
        function logoutPopup() {
            document.getElementById("logout_model").style.display = "flex";
        }
        function logout() {
            window.location.href = "logout.php";
        }

        function logout_cancel() {
            document.getElementById("logout_model").style.display = "none";
        }

        function timeAgo(datetime) {
            const now = new Date();
            const past = new Date(datetime);
            const diff = Math.floor((now - past) / 1000);

            if (diff < 60) return " Just now";

            const minutes = Math.floor(diff / 60)
            if (minutes < 60) return minutes + " min ago";

            const hours = Math.floor(minutes / 60)
            if (hours < 24) return hours + " hr ago";

            const days = Math.floor(hours / 24)
            if (days < 7) return days + " days ago";

            const week = Math.floor(days / 7)
            if (week < 4) return week + " week ago";

            const months = Math.floor(days / 31)
            if (months < 12) return months + " months ago"

            const years = Math.floor(days / 365)
            return years + " year ago";
        }

        function toggleNotiBox() {
            let box = document.getElementById('noti_box');
            if (box.style.display === "block") {
                box.style.display = "none";
            } else {
                box.style.display = "block";
                loadNotifications();
                markAsread();
            }
        }
        function loadNotifications() {
            fetch('notification/get_notification.php')
                .then(res => res.json())
                .then(data => {
                    let list = document.getElementById('noti_list');
                    let msg_time = document.getElementById('msg_time');

                    if (data.length > 0) {
                        list.innerHTML = data.map(n => `
                        <div class="noti_item_${n.is_read == 0 ? 'unread' : 'read'}">
                        <p class="message">
                        ${n.is_read == 0 ? '<span class="new_badge">New</span>' : ''}
                        ${n.message}
                        </p>
                        <span class="msg_time">${timeAgo(n.created_at)}</span>
                        </div> `).join('');
                    } else {
                        list.innerHTML = '<p style="padding:10px;">Not any notifications</p>';
                    }

                })
        }
        function loadUnreadCount() {
            fetch("notification/get_unread_count.php")
                .then(res => res.json())
                .then(data => {
                    let count = document.getElementById("notification_count");
                    if (data.total > 0) {
                        count.innerText = data.total;
                        count.style.display = "block";
                    } else {
                        count.style.display = "none";
                    }
                })
        }
        setInterval(loadUnreadCount, 2000);

        function markAsread() {
            fetch("notification/notification_seen.php")
                .then(res => res.json())
                .then(data => {
                    loadUnreadCount();
                })
        }

        let notification = document.getElementById("notification");
        notification.addEventListener("click", function (e) {
            e.stopPropagation();
        })
        document.addEventListener("click", function () {
            document.getElementById("noti_box").style.display="none";
        })