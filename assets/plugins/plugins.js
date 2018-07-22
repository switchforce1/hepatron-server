const $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it

//require.context('./extra_layout', false, /\.png$|.ico$/);
require.context('./extra_layout/js');
//require.context('./Ionicons/');
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');
