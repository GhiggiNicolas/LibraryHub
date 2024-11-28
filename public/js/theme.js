const btn = document.querySelector('#theme-toggle-btn');
const icon = btn.querySelector('i');

const getCookie = (name) => {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
};

const setCookie = (name, value, days) => {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + d.toUTCString();
    document.cookie = `${name}=${value}; ${expires}; path=/`;
};

const themeToggle = () => {
    const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    document.documentElement.classList.toggle('dark');
    setCookie('theme', newTheme, 365);

    if (newTheme === 'dark') {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    } else {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    }
};

btn.addEventListener('click', themeToggle);

window.addEventListener('load', () => {
    const savedTheme = getCookie('theme');
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    } else {
        document.documentElement.classList.remove('dark');
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    }
});
