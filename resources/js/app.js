import './bootstrap';

if (document.querySelector('.sidebar-wrapper') && typeof PerfectScrollbar !== 'undefined') {
    new PerfectScrollbar('.sidebar-wrapper');
}
