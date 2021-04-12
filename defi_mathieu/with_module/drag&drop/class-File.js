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
        fetch(uri)
        .then((response)=>{
            if (response.ok) return response.blob;
            else {
                console.log('File : ' + uri);
                console.log('Network error : ' + response.statusText)
            };
        })
        .catch((errors)=>{
            console.log(errors);
        })
        .finally((blob)=>{
            console.log('finnally');
            this.uri = uri;
            this.filename = uri.split('/')[uri.length - 1];
            this.content = blob;
            MyFile.FilesList.uri = this;
            if(callback != null)
            callback();
        });
    }

    /**
     * 
     * @param {*} callback 
     * @returns this
     */
    save(callback){

        data = new FormData();
        data.append('uri', this.uri);
        data.append('filename', this.filename);
        data.append('content', this.content);

        fetch(this.uri, {
            'method': 'POST',
            'body': data
        })
        .then((response)=>{
            if (response.ok) return response.json();
            else console.log('Network error : '+response.statusText);
        })
        .catch((errors)=>{
            console.log(errors);
        })
        .finally((data)=>{
            if(callback != null)
            callback(data);
        });

    }
}