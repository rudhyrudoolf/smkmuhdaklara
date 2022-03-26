var app = {};

(function ($, app) {
    // Global variables.
    app.ThousandSeparator = (text) => {
        if (!app.checkObj.isEmptyNullOrUndefined(text)) {
            var nStr = text.toString();
            //nStr = nStr.substring(0, 6);
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? ',' + x[1].substring(0, 2) : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }
        if (typeof (text) === Number) return text.toString("n2");
        return 0;
    };

    // app.checkObj
    app.checkObj = {};

    app.checkObj.isEmptyNullOrUndefined = function (param) {
        if (param === undefined) { return true };
        if (param === null) { return true };
        if (this.isString(param)) { return param.replace(/\s+/g, '') === '' };
        return false;
    };

    app.checkObj.isString = function (param) {
        return Object.prototype.toString.call(param) === '[object String]';
    };
}(jQuery, app));