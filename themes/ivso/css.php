<style>
    :root {
        --bs-primary-rgb: 14, 34 , 68;
        --bs-primary: #0e2244;
        --bs-primary-bg-subtle: #648cd0;
    }

    .btn-primary {
        --bs-btn-bg: #0e2244;
        --bs-btn-border-color: #0e2244;
        --bs-btn-disabled-border-color: #0e2244;
        --bs-btn-disabled-bg: #0e2244;
        --bs-btn-hover-bg: #1a335d;
        --bs-btn-active-bg: #1a335d;
        --bs-btn-hover-border-color: #3e5a8a;
        --bs-btn-active-border-color: #6681af;
    }

    body {
        background-color: #efefef;
    }

    #main_container {
        background-color: white;
    }

    #carrousel {
        position: relative;
        display: flex;
    }

    #precedent,
    #suivant {
        cursor: pointer;
        transition: opacity 0.3s ease;
        opacity: 0;
        position: absolute;
        font-size: 20px;
        color: rgba(220, 220, 220, 0.8);
        background-color: rgba(0, 0, 0, 0.8);
        padding: 10px;
    }

    #precedent {
    left: 0;
    }

    #suivant {
        right: 0;
    }

    #carrousel:hover #precedent,
    #carrousel:hover #suivant {
        opacity: 1;
    }

    .img-preview {
        display: block;
        height: 200px;
        cursor: pointer;
    }
</style>
