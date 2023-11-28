<template>
    <div class="">
        <!-- <qrcode-vue :value="userId" size="350" level="H"></qrcode-vue> -->
        <QRCodeVue3
          :width="300"
          :height="300"
          :value="qrcode"
          margin=17
          :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'M' }"
          :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
          :dotsOptions="{
            type: 'classy',
            color: '#facc15',
            gradient: {
              type: 'linear',
              rotation: 0,
              colorStops: [
                { offset: 0, color: '#7f1d1d' },
                { offset: 1, color: '#000' },
              ],
            },
          }"
          :backgroundOptions="{ color: '#f1f1f1' }"
          :cornersSquareOptions="{ type: 'Dot', color: '#7f1d1d' }"
          :cornersDotOptions="{ type: undefined, color: '#000000' }"
          fileExt="png"
          :download="true"
          myclass="my-qur"
          imgclass="img-qr"
          downloadButton="my-button"
          :downloadOptions="{ name: this.name.toLowerCase(), extension: 'png' }"
        />
    </div>
</template>
<script>
import QrcodeVue from 'qrcode.vue'
import QRCodeVue3 from "qrcode-vue3";
export default {
    props: ['qrcode', 'name'],
    components: {
        QrcodeVue,
        QRCodeVue3
    }
}
</script>
<style>
/* .container {
  position: relative;
  background-color: red;
  display: flex;
  align-items: center;
  justify-content: flex-start;

}
.my-button {
  background-color: #60a5fa;
  color: #ffff;
  padding: 3px 5px 3px 5px;
  width: 100%;
  margin-top: 5px;
  position: absolute;
  left: 10px;
} */


</style>
vbase
