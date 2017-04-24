
var Core = (function () {

    var Core = function () {
    };

    var key;

    Core.prototype.html = function (template, keyValues) {
        for (key in keyValues) {
            var re = '\\$\{' + key + '\}';
            template = template.replace(new RegExp(re, "g"), keyValues[key]);
        }
        return template;
    };

    Core.prototype.uploadFile = function (url, formData, progress, complete, error, cancel) {
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", progress, false);
        xhr.addEventListener("load", complete, false);
        if (error) {
            xhr.addEventListener("error", error, false);
        }
        if (cancel) {
            xhr.addEventListener("abort", cancel, false);
        }
        xhr.open("POST", url);//修改成自己的接口
        xhr.send(formData);
    };
    
    return Core;
})();