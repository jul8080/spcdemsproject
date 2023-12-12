import { ref , watch } from "vue"
const useImageUploader  = () => {
    const imageFile = ref('')
    const imageUrl= ref('')

    const handleImageForm = (event) => {
        if(event.target.files.length === 0) {
            imageFile.value = ''
            imageUrl.value = ''
            return;
        }
        imageFile.value = event.target.files[0]
    }
    watch(imageFile, (imageFile) => {

        if(!(imageFile instanceof File)) {
            return;
        }
        let fileReader = new FileReader();

        fileReader.readAsDataURL(imageFile)

        fileReader.addEventListener('load', () => {
            imageUrl.value = fileReader.result
        })

    })
    return { imageFile, imageUrl, handleImageForm }
}

export default useImageUploader;