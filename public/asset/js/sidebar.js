let expanded = false;
let isAdminOpen = false;
let isOpen = false;

// Get elements
const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const expandedLogo = document.getElementById('expandedLogo');
const collapsedLogo = document.getElementById('collapsedLogo');
const navHeader = document.getElementById('navHeader');
const dashboardText = document.getElementById('dashboardText');
const productText = document.getElementById('productText');
const listText = document.getElementById('listText');
const arrowIcon = document.getElementById('arrowIcon');
const listDropDown = document.getElementById('ListDropdown');
const listBtn = document.getElementById('listButton');
const BtnAdmin = document.getElementById('BtnAdmin');
const AdminDropDown = document.getElementById('AdminDropDown');

// Function to toggle Admin dropdown
const openDropDownAdmin = () => {
    isAdminOpen = !isAdminOpen;
    AdminDropDown.style.display = isAdminOpen ? 'block' : 'none';
};

// Function to toggle List dropdown
const openDropDrown = () => {
    isOpen = !isOpen;
    
    if (isOpen) {
        listDropDown.style.display = 'block';
        arrowIcon.style.transform = 'rotate(90deg)';
    } else {
        listDropDown.style.display = 'none';
        arrowIcon.style.transform = '';
    }
};

// Function to toggle sidebar that respects Tailwind breakpoints
const toggleSideBar = () => {
    expanded = !expanded;
    
    // Check if we're above the lg breakpoint (1024px in Tailwind by default)
    const isLargeScreen = window.matchMedia('(min-width: 1024px)').matches;
    
    if (expanded) {
        // Expand sidebar
        sidebar.classList.remove('w-[88px]');
        sidebar.classList.add('w-[240px]');
        
        collapsedLogo.classList.add('hidden');
        expandedLogo.classList.remove('hidden');
        navHeader.classList.remove('hidden');
        dashboardText.classList.remove('hidden');
        productText.classList.remove('hidden');
        listText.classList.remove('hidden');
        
        if (isLargeScreen) {
            arrowIcon.classList.remove('hidden');
        }
    } else {
        // Collapse sidebar
        sidebar.classList.remove('w-[240px]');
        sidebar.classList.add('w-[88px]');
        
        collapsedLogo.classList.remove('hidden');
        expandedLogo.classList.add('hidden');
        navHeader.classList.add('hidden');
        dashboardText.classList.add('hidden');
        productText.classList.add('hidden');
        listText.classList.add('hidden');
        
        if (isLargeScreen) {
            arrowIcon.classList.add('hidden');
        }
    }
    
    // For mobile screens, we might want different behavior
   // For mobile screens, we might want different behavior
if (!isLargeScreen) {
    if (expanded) {
        // If expanded on mobile, add a special mobile class
        sidebar.classList.add('mobile-expanded');
        sidebar.classList.remove('mobile-collapsed');
        
        // Use classList instead of inline styles for the toggle button
        sidebarToggle.classList.add('sidebar-toggle-expanded');
        
        // Prevent body scrolling when sidebar is open on mobile
        document.body.style.overflow = 'hidden';
    } else {
        // If collapsed on mobile
        sidebar.classList.remove('mobile-expanded');
        sidebar.classList.add('mobile-collapsed');
        
        // Reset toggle button position
        sidebarToggle.classList.remove('sidebar-toggle-expanded');
        
        // Restore body scrolling
        document.body.style.overflow = '';
    }
}
};

// Event listeners
sidebarToggle.addEventListener('click', toggleSideBar);
listBtn.addEventListener('click', openDropDrown);
BtnAdmin.addEventListener('click', openDropDownAdmin);

// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!BtnAdmin.contains(e.target) && !AdminDropDown.contains(e.target) ) {
        isAdminOpen = false;
        AdminDropDown.style.display = 'none';
    }
});

document.addEventListener('click', (e) => {
    if (!listBtn.contains(e.target) && !listDropDown.contains(e.target)) {
        isOpen = false;
        listDropDown.style.display = 'none';
    }
});

// Handle window resize
window.addEventListener('resize', () => {
    const isLargeScreen = window.matchMedia('(min-width: 1024px)').matches;
    
    // Reset mobile-specific classes when screen size changes
    if (isLargeScreen) {
        sidebar.classList.remove('mobile-expanded', 'mobile-collapsed');
        document.body.style.overflow = '';
        
        // Restore desktop state based on expanded variable
        if (expanded) {
            sidebar.classList.remove('w-[88px]');
            sidebar.classList.add('w-[240px]');
        } else {
            sidebar.classList.remove('w-[240px]');
            sidebar.classList.add('w-[88px]');
        }
    } else {
        // On smaller screens, check if we need to collapse
        if (!expanded) {
            sidebar.classList.add('mobile-collapsed');
        }
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    const isLargeScreen = window.matchMedia('(min-width: 1024px)').matches;
    
    // Set initial state
    if (!isLargeScreen && !expanded) {
        sidebar.classList.add('mobile-collapsed');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    let notificationButton = document.getElementById("notificationButton");
    let notificationDropdown = document.getElementById("notificationDropdown");
    let markAsReadButton = document.getElementById("markAsRead");
    let notificationCount = document.getElementById("notificationCount");

    // Toggle Dropdown
    notificationButton.addEventListener("click", function () {
        notificationDropdown.classList.toggle("hidden");
    });

    // Mark notifications as read
    markAsReadButton.addEventListener("click", function () {
        fetch("{{ route('notifications.markAsRead') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
            },
        }).then(response => {
            if (response.ok) {
                notificationCount.classList.add("hidden");
            }
        });
    });

    // Auto-update notifications every 30 seconds
    setInterval(() => {
        fetch("{{ route('notifications.count') }}")
            .then(response => response.json())
            .then(data => {
                if (data.count > 0) {
                    notificationCount.innerText = data.count;
                    notificationCount.classList.remove("hidden");
                } else {
                    notificationCount.classList.add("hidden");
                }
            });
    }, 30000);
});
