export default class Errors{ // klasa obsługująca błedy walidacji w formularzach
    constructor(){
        this.errors = [];
    }
        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        get(field) {
             if(this.errors[0]){
              return this.errors[0].lenght;
            }
        }

        getStart(field) {
            if(this.errors[0]){
                if(this.errors[0].errors["startNumber."+field] !== undefined)
                return this.errors[0].errors["startNumber."+field].join(" ");
            }
        }

        getEnd(field) {
            if(this.errors[0]){
                if(this.errors[0].errors["endNumber."+field] !== undefined)
                return this.errors[0].errors["endNumber."+field].join(" ");
            }
        }

        getEditStart() {
            if(this.errors[0]){
                if(this.errors[0].errors["startNumber"] !== undefined)
                return this.errors[0].errors["startNumber"].join(" ");
            }
        }

        getEditEnd() {
            if(this.errors[0]){
                if(this.errors[0].errors["endNumber"] !== undefined)
                return this.errors[0].errors["endNumber"].join(" ");
            }
        }

        record(errors){
            this.clearAll()
            this.errors.push(errors);
        }

        clear(field){
            delete this.errors[field];
        }

        clearAll(){
            this.errors = [];
        }
    }
