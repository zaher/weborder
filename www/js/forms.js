function submit_fld(url, fld_id, def)
{
  var fld = document.getElementById(fld_id);
  var s = fld.value;
  if (!s)
    s = def;
  location.href=url + s;
}

function submit_div(url, parent)
{
}