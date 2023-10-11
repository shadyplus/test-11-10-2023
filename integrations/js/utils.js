// Form anchor
const targetForScroll = 'form_form';
const elements = document.getElementsByTagName('a');
for (const element of elements) {
  element.setAttribute('href', '#' + targetForScroll)
  element.addEventListener('click', function (event) {
    event.preventDefault();
    document.getElementById(targetForScroll).scrollIntoView({
      behavior: 'smooth',
      block: 'start',
    });
  });
}