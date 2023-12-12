const randomStringGenerator = (number) => {
    var random_string = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'
    var symbols = "!@#$%&^_+:\<>?;'-/\*~"
    var all_chars = characters + symbols
    for (var i, i = 0; i < number; i++) {
        random_string += all_chars.charAt(Math.floor(Math.random() * all_chars.length))
    }
    return random_string
}
export default randomStringGenerator