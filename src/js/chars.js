var allDictionaryItems = document.querySelectorAll(".dictionary_item");
var allDictionaryArray = [];
var charArray = [];

function createChar(item, char) {
  var newChar = document.createElement("div");
  newChar.className =
    "dictionary_varchar w-full text-3xl text-blue-500 font-bold lg:px-4 mt-4 mb-6";
  newChar.innerHTML = char;
  item.before(newChar);
}

for (allDictionaryItem of allDictionaryItems) {
  if (allDictionaryItem) {
    var dictionaryName = allDictionaryItem.textContent;
    dictionaryChar = dictionaryName.replace(/\s/g, "").charAt(0);
    if (charArray.includes(dictionaryChar)) {
      console.log("уже есть");
    } else {
      charArray.push(dictionaryChar);
      createChar(allDictionaryItem, dictionaryChar);
    }
  }
}
