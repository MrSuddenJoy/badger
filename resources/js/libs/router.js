export default class Router {
    constructor() {
        this._location = window.location.pathname.toLocaleLowerCase() || '/';
        this._routes = {};
    }

    on(paths, handler) {
        paths.forEach(item => this._routes[item] = handler);
        return this;
    }

    resolve() {
        for (const path in this._routes) {
            if (Object.prototype.hasOwnProperty.call(this._routes, path)) {
                if (this._compile(path).test(this._location)) {
                    this._routes[path]();
                    break;
                }
            }
        }
    }

    _compile(path) {
        return new RegExp(
            '^' +
            prepend(path).replace('*', '.*') +
            '$',
            'i');
    }
}

function prepend(string) {
    if (string.startsWith('/')) {
        return string;
    }
    return '/' + string;
}
