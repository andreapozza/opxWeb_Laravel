export function slugify(value) {
  if(!value) return '';
  return value.toString()
    .toLowerCase()
    .replace(/[^a-z0-9À-ẑ]/g, '-')
    .replace(/[-]{2,}/g, '-')
    .replace(/^-|-$/g, '')
}

export function stripHtml(html) {
  if(!html) return '';
   let tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}