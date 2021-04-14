export class MyFile {
    
    static FilesList = {};
    
    constructor(source = null, callback = null)
    {
        this.uri = null;
        this.filename = null;
        this.content = null;

        if (source != null){
            if (source.match(/^https?\:\/\//))
                this.load(source, callback);
            if (source instanceof File) 
                this.import(source, callback);
        }
    }

    /**
     * Import from File API
     * 
     * @param {*} file 
     */
    import(file, callback)
    {
        file.content;

    }


    /**
     * Import from server
     * 
     * @param {*} uri 
     * @returns this
     */
    load(uri, callback)
    {
        fetch(uri, {
            method:'GET'
        })
        .then((response)=>{
            if (response.ok) return response.blob();
            else {
                console.log('File : ' + uri);
                console.log('Network error : ' + response.statusText)
            };
        })
        .then((data)=>{
            console.log(data)
            
            this.uri = uri;
            this.filename = uri.split('/')[uri.length - 1];
            // this.content = response.blob();
            MyFile.FilesList.uri = this;
        })
        .catch((errors)=>{
            console.log(errors);
        })
        .finally(()=>{
            if(callback != null) callback(this);
        });
        
    }
    
    /**
     * 
     * @param {*} callback 
     * @returns this
     */
    save(uriBackScript, callback){
        
        data = new FormData();
        data.append('uri', this.uri);
        data.append('filename', this.filename);
        data.append('content', this.content);
        
        fetch(uriBackScript, {
            'method': 'POST',
            'body': data
        })
        .then((response)=>{
            if (response.ok) this.data = response.json();
            else console.log('Network error : '+response.statusText);
        })
        .then((data)=>{

        })
        .catch((errors)=>{
            console.log(errors);
        })
        .finally(()=>{
            if(callback != null)
            callback(this.data);
        });
    }
}