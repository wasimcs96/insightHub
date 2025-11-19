export default class ApiService {
    constructor() {
        this.token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        this.headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': this.token,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        };
    }

    async get(url, params = {}) {
        const queryString = new URLSearchParams(params).toString();
        const fullUrl = queryString ? `${url}?${queryString}` : url;
        
        try {
            const response = await fetch(fullUrl, {
                method: 'GET',
                headers: this.headers,
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('GET request failed:', error);
            throw error;
        }
    }

    async post(url, data = {}) {
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: this.headers,
                credentials: 'same-origin',
                body: JSON.stringify({
                    ...data,
                    _token: this.token
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('POST request failed:', error);
            throw error;
        }
    }

    async getWithAbort(url, params = {}) {
        this.controller = new AbortController();
        const queryString = new URLSearchParams(params).toString();
        const fullUrl = queryString ? `${url}?${queryString}` : url;
        
        try {
            const response = await fetch(fullUrl, {
                method: 'GET',
                headers: this.headers,
                credentials: 'same-origin',
                signal: this.controller.signal
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('GET request with abort failed:', error);
            }
            throw error;
        }
    }

    abort() {
        if (this.controller) {
            this.controller.abort();
        }
    }
}