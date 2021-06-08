<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
    <a href="{{route('user.line.login')}}" class="relative"  x-data="swapImg()" x-on:click="press()" x-on:mouseover="hover()" x-on:mouseleave="base">
        <img src="{{asset('images/btn_login_base.png')}}" alt="Lineログインボタン" x-show="show == 'base'">
        <img src="{{asset('images/btn_login_hover.png')}}" alt="Lineログインボタン" x-show="show == 'hover'">
        <img src="{{asset('images/btn_login_press.png')}}" alt="Lineログインボタン" x-show="show == 'press'">
    </a>
    <script>
        function swapImg() {
            return{
                show: 'base',
                base() {this.show = 'base'},
                hover() {this.show = 'hover'},
                press() {this.show = 'press'},
            }
        }
    </script>
</div>