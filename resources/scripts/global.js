document.getElementById('startAgain').onclick = function () {
  var hidden = document.createElement('INPUT');
  hidden.type = 'hidden';
  hidden.name = 'reset';
  hidden.value = '1';

  var form = document.createElement('FORM');
  form.method = 'post';
  form.appendChild(hidden);

  document.body.appendChild(form);
  form.submit();
};