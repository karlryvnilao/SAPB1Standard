<style>
.spinner {
    position: fixed;
    left: 52%;
    top: 39%;
    height:160px;
    width:160px;
    margin:0px auto;
    -webkit-animation: rotation .6s infinite linear;
    -moz-animation: rotation .6s infinite linear;
    -o-animation: rotation .6s infinite linear;
    animation: rotation .6s infinite linear;
    border-left:16px solid rgba(0,174,239,.15);
    border-right:16px solid rgba(0,174,239,.15);
    border-bottom:16px solid rgba(0,174,239,.15);
    border-top:16px solid rgba(0,174,239,.8);
    border-radius:100%;
}

@-webkit-keyframes rotation {
    from {-webkit-transform: rotate(0deg);}
    to {-webkit-transform: rotate(359deg);}
}
@-moz-keyframes rotation {
    from {-moz-transform: rotate(0deg);}
    to {-moz-transform: rotate(359deg);}
}
@-o-keyframes rotation {
    from {-o-transform: rotate(0deg);}
    to {-o-transform: rotate(359deg);}
}
@keyframes rotation {
    from {transform: rotate(0deg);}
    to {transform: rotate(359deg);}
}
</style>
<div id="loadingAnimation" class="spinner"></div>