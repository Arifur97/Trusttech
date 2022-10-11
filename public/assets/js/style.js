function gotoSpecification() {
    document.getElementById("product-info-tab").scrollIntoView({ behavior: "smooth", block: 'center' });
}

$('.specification-inner table tr td p strong').parent().parent().css({
    'background': getComputedStyle(document.body).getPropertyValue('--color-primary'),
    'color': 'white',
});
$('.specification-inner table tr td h5').parent().css({
    'background': getComputedStyle(document.body).getPropertyValue('--color-primary'),
    'color': 'white',
});
$('.specification-inner table tr td h5').css({
    'color': 'white',
});