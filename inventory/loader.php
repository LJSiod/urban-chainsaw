<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); 
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999; 
    }

    /* From Uiverse.io by Nawsome */
    .loader {
        width: 130px;
        height: 170px;
        position: relative;
        font-family: inherit;
    }

    .loader::before, .loader::after {
        content: "";
        width: 0;
        height: 0;
        position: absolute;
        bottom: 30px;
        left: 15px;
        z-index: 1;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-bottom: 20px solid #1b2a33;
        transform: scale(0);
        transition: all 0.2s ease;
    }

    .loader::after {
        border-right: 15px solid transparent;
        border-bottom: 20px solid #162229;
    }

    .loader .getting-there {
        width: 120%;
        text-align: center;
        position: absolute;
        bottom: 0;
        left: -7%;
        font-size: 12px;
        letter-spacing: 2px;
        color: white;
    }

    .loader .binary {
        width: 100%;
        height: 140px;
        display: block;
        color: white;
        position: absolute;
        top: 0;
        left: 15px;
        z-index: 2;
        overflow: hidden;
    }

    .loader .binary::before, .loader .binary::after {
        font-family: "Lato";
        font-size: 24px;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .loader .binary:nth-child(1)::before {
        content: "🎧";
        animation: a 1.1s linear infinite;
    }

    .loader .binary:nth-child(1)::after {
        content: "🖱️";
        animation: b 1.3s linear infinite;
    }

    .loader .binary:nth-child(2)::before {
        content: "⌨️";
        animation: c 0.9s linear infinite;
    }

    .loader .binary:nth-child(2)::after {
        content: "💻";
        animation: d 0.7s linear infinite;
    }

    .loader .binary:nth-child(3)::before {
        content: "📱";
        animation: e 1.2s linear infinite;
    }

    .loader .binary:nth-child(3)::after {
        content: "🔌";
        animation: f 1.5s linear infinite;
    }

    .loader .binary:nth-child(4)::before {
        content: "💽";
        animation: g 1s linear infinite;
    }

    .loader .binary:nth-child(4)::after {
        content: "💾";
        animation: h 1.4s linear infinite;
    }

    .loader.JS_on::before, .loader.JS_on::after {
        transform: scale(1);
    }

    @keyframes a {
        0% {
            transform: translate(30px, 0) rotate(30deg);
            opacity: 0;
        }
        100% {
            transform: translate(30px, 150px) rotate(-50deg);
            opacity: 1;
        }
    }

    @keyframes b {
        0% {
            transform: translate(50px, 0) rotate(-40deg);
            opacity: 0;
        }
        100% {
            transform: translate(40px, 150px) rotate(80deg);
            opacity: 1;
        }
    }

    @keyframes c {
        0% {
            transform: translate(70px, 0) rotate(10deg);
            opacity: 0;
        }
        100% {
            transform: translate(60px, 150px) rotate(70deg);
            opacity: 1;
        }
    }

    @keyframes d {
        0% {
            transform: translate(30px, 0) rotate(-50deg);
            opacity: 0;
        }
        100% {
            transform: translate(45px, 150px) rotate(30deg);
            opacity: 1;
        }
    }

    @keyframes e {
        0% {
            transform: translate(30px, 0) rotate(40deg);
            opacity: 0;
        }
        100% {
            transform: translate(35px, 150px) rotate(-20deg);
            opacity: 1;
        }
    }

    @keyframes f {
        0% {
            transform: translate(40px, 0) rotate(15deg);
            opacity: 0;
        }
        100% {
            transform: translate(40px, 150px) rotate(-45deg);
            opacity: 1;
        }
    }

    @keyframes g {
        0% {
            transform: translate(60px, 0) rotate(60deg);
            opacity: 0;
        }
        100% {
            transform: translate(50px, 150px) rotate(-20deg);
            opacity: 1;
        }
    }

    @keyframes h {
        0% {
            transform: translate(30px, 0) rotate(-30deg);
            opacity: 0;
        }
        100% {
            transform: translate(30px, 150px) rotate(20deg);
            opacity: 1;
        }
    }

</style>

<div class="loading-overlay" id="loader">
    <div class="loader JS_on">
        <span class="binary"></span>
        <span class="binary"></span>
        <span class="binary"></span>
        <span class="binary"></span>
        <span class="getting-there">LOADING STUFF...</span>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loader').show();
        $('#content').hide();
    });

    $(window).on('load', function() {
        $('#loader').hide();
        $('#content').show();
    });
</script>
