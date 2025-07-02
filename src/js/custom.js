var clipboard = new ClipboardJS('.copy-click');
clipboard.on('success', function (e) {
  let copyBtns = document.querySelectorAll('.copy-click');
  for (copyBtn of copyBtns) {
    copyBtn.innerHTML = "Копіювати";
    copyBtn.classList.remove("success");
  }
  let classTriger = e.trigger;
  classTriger.innerHTML = "Скопіювали";
  classTriger.classList.add('success');
});