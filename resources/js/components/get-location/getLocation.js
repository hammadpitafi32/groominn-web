import { onUnmounted, onMounted, ref, watchEffect } from 'vue'

export function useGeolocation() {
  const coords = ref({ latitude: 0, longitude: 0 })
  const isSupported = 'navigator' in window && 'geolocation' in navigator

  let watcher = null

  const grandStatus = ref(null);

  const checkStatus = () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(async () => {
        grandStatus.value = 'granted';
        watcher = navigator.geolocation.watchPosition(position => (coords.value = position.coords))
      }, function (error) {
        grandStatus.value = 'denied';
        alert('Please grant the geolocation permission')
      })

    } else {
      alert("Sorry, your browser does not support HTML5 geolocation.")
    }

  }

  watchEffect(() => {
    checkStatus();
  });

  onUnmounted(() => {
    if (watcher) navigator.geolocation.clearWatch(watcher)
  })

  return { coords, isSupported }
}