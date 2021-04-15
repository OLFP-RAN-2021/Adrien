
/**
 * Import drop area class
 */
import { DragAndDrop } from "./class-DragAndDrop.js";

/**
 * 
 */
new DragAndDrop({
    
    // tag id : where you want to append the drag&drop
    'DropTagId':'drop-module',

    // forms : form id / is async (depend of form or not)
    'form': {'form_id':'', 'is_async':false },

    // drop area element properties
    'DropArea': {"id":'dropArea', "class":'droparea'}
});


