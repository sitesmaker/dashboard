<template>
    <div class="home"></div>
</template>

<!-- <script>
export default {
    computed: {
        mobile() {
            let mq = null;
            console.log(innerWidth)

            if(window.innerWidth < 768) {
                console.log(1)
                mq = 'mobile';
            } else {
                mq = null;
            }

            return mq;
        }
    }
}
</script> -->

<style lang="scss"  >
.home {
    height: 100vh;
    background-image: url(@img/first-screen.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 50% 0%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: -$header-h;

    &::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0, .7);

    }

    h1{
        color: $white;
        font-size: 50px;
        text-align: center;
        position: relative;
    }
}
</style>
