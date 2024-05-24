<template>
    <div class="customHeader">
        <b-container fluid="lg">
            <div class="custom-navbar-bg custom-navbar-sticky shadow-sm"> 
                <nav class="navbar navbar-expand-lg content-layout">
                    <div class="d-flex align-items-center">
                        <a href="https://test.pipesales.dev" aria-label="Home Page" class="navbar-brand custom-navbar-logo mr-2">
                            <img src="https://test.pipesales.dev/view2/image/pipesales.svg" alt="Pipesales Logo" loading="lazy" class="w-100">
                        </a>
                    </div>
                </nav>
            </div>
        </b-container>
        <div class="banner">
            <b-container fluid="lg">
                <img src="images/tomi-full.png" alt="pipesales" />
                <div class="col-12 col-md-8 col-lg-9 p-3 py-md-0 mx-md-0 my-md-auto custom-header-text-wrapper">
                    <h1 class="custom-header-text-default">Your global marketplace to</h1>
                    <div class="custom-header-text-color mt-1 mb-3 mt-md-2 mb-md-4">buy &amp; sell tubular products</div>
                    <div class="custom-header-sub-text mb-md-5">Quickly overcome supply gaps and target zero inventory with
                        Pipesales.</div>
                </div>
            </b-container>
        </div>
    </div>
</template>
<style>
.customHeader{
    background-color: var(--white);
}
.banner{
    background-image: url(/images/header-background-2.webp);
    background-repeat: no-repeat;
    background-size: contain;
    background-color: var(--blue-3);
    height: 500px;
    max-width: 100%;
    display: flex;
    justify-content: center;
}
.banner img{
    height: 100%;
}
.banner .custom-header-text-wrapper{
    position: absolute;
    top: 160px;
    left: 300px;
}
.container-lg{
    position: relative;
}

</style>