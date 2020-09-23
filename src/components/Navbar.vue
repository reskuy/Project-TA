<template>
<v-container
      class="overflow-hidden"
    >
    <!-- NavBar Atas -->
    <Appbar/>
  <!--NAV kiri -->
   <Navdrawer/>   
</v-container>
</template>

<script>
import Appbar from '@/views/Appbar'
import Navdrawer from '@/views/Navdrawer'
export default {
  components: {
    Appbar,
    Navdrawer
  },data() {
    return {
      
    }
  },
}
</script>