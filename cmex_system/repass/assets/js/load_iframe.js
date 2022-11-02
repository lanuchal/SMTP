function loadIframe(iframeId, url) {
    var $iframe = $('#' + iframeId);
    if ( $iframe.length ) {
        $iframe.attr('src',url);   
        return false;
    }
    return true;
}