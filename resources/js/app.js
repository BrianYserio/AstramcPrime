import './bootstrap';

// sidebar toggle button

const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const content = document.getElementById('main-content');

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        content.classList.toggle('ml-[250px]');
        content.classList.toggle('ml-0');
        toggle.classList.toggle('rotate-180');
});



   //  FIX 1: previewImage() defined here

        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                // FIX 2: targets the img by id="profile-preview"
                document.getElementById('profile-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        // FIX 3: Select-All properly dispatches 'change' so CSS peer state updates
        function toggleAllDays(checked) {
            document.querySelectorAll('.day-checkbox').forEach(cb => {
                if (cb.checked !== checked) {
                    cb.checked = checked;
                    cb.dispatchEvent(new Event('change'));
                }
            });
        }
