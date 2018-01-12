<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use DNS1D;
    use App\Models\Produtos;
    use App;
    use App\Models\Estoque;
   use App\Models\EnvioItem;

    

	class AdminProdutosController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = true;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "produtos";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Codigo","name"=>"codigo"];
			$this->col[] = ["label"=>"Nome","name"=>"nome"];
			$this->col[] = ["label"=>"Valor","name"=>"valor","callback_php"=>'"R$ ".$row->valor'];


			if(CRUDBooster::myPrivilegeName() != "Colabers"){

				$this->col[] = ["label"=>"Colaber","name"=>"user_id","join"=>"cms_users,name"];
			}
			


			
			$this->col[] = ["label"=>"Estoque Feira","name"=>"descricao","callback"=>function($row){
				
				$entrada = Estoque::where([['produto_id', $row->id],['operacao',1]])->count();
				$saida = Estoque::where([['produto_id', $row->id],['operacao',2]])->count();
				$venda = Estoque::where([['produto_id', $row->id],['operacao',3]])->count();
				$count = $entrada - $saida - $venda;

				
				switch ($count) {
					case 0:
						$estoque = "<span class='label label-warning'>Sem Estoque</span>";
						break;
					
					case $count < 0:
						$estoque = "<span class='label bg-purple color-palette'>$count</span>";
					break;

					case $count < 2:
						$estoque = "<span class='label label-primary'>$count</span>";
					break;



					default:
						$estoque = "<span class='label label-success'>$count</span>";
					break;
				}

					
				


				
				return $estoque;
			}];



			if(CRUDBooster::myPrivilegeName() != "Colabers"){

				
				$this->col[] = ["label"=>"Ultima Remessa","name"=>"descricao","callback"=>function($row){
				

				$envios = EnvioItem::where('produto_id', $row->id)->orderBy('id','desc')->first();
				
	
				switch ($envios->qtde) {
					case 0:
						$estoque = "<span class='label label-warning'>SEM REMESSA</span>";
						break;
					
					case $envios->qtde < 0:
						$estoque = "<span class='label bg-purple color-palette'>$envios->qtde</span>";
					break;

					case $envios->qtde < 2:
						$estoque = "<span class='label label-primary'>$envios->qtde</span>";
					break;



					default:
						$estoque = "<span class='label label-success'>$envios->qtde</span>";
					break;
				}

					
				


				
				return $estoque;
			}];


			}

			



			$this->col[] = ["label"=>"Categoria","name"=>"categoria_id","join"=>"categorias,nome"];

			
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];

			$userId = CRUDBooster::myId();
			




			if(CRUDBooster::myPrivilegeName() != "Colabers"){

				$this->form[] = ['label'=>'Colaber','name'=>'user_id','type'=>'select2','datatable'=>'cms_users,name','width'=>'col-sm-5','validation'=>'required'];

			}
			else{

				$this->form[] = ['label'=>'UserID','name'=>'user_id','type'=>'hidden','width'=>'col-sm-10','value'=>$userId];

			}

			



			$this->form[] = ['label'=>'Nome','name'=>'nome','type'=>'text','validation'=>'required|string|min:3|max:35','width'=>'col-sm-6','placeholder'=>'Utilize nomes distintos. Ex: Bolsa Jeans Reciclado P'];

			$this->form[] = ['label'=>'Valor R$','name'=>'valor','type'=>'text','validation'=>'required','width'=>'col-sm-5','placeholder'=>'Digite somente números'];
			
			$this->form[] = ['label'=>'Categoria','name'=>'categoria_id','type'=>'select2','datatable'=>'categorias,nome','datatable_ajax'=>false,'width'=>'col-sm-5','validation'=>'required','placeholder'=>'test'];
			$this->form[] = ['label'=>'Cor','name'=>'cor','type'=>'text','width'=>'col-sm-5','placeholder'=>'Qual é a cor predominante do seu produto?','validation'=>'required'];
			$this->form[] = ['label'=>'Acabamento','name'=>'acabamento','type'=>'text','width'=>'col-sm-5','placeholder'=>'Ex: Tecido Digital com Couro.'];
			$this->form[] = ['label'=>'Tamanho','name'=>'tamanho','type'=>'text','width'=>'col-sm-5','placeholder'=>'Qual o tamanho do seu produto?','validation'=>'required'];
			
			$this->form[] = ['label'=>'Descricao','name'=>'descricao','type'=>'textarea','width'=>'col-sm-5','validation'=>'required','placeholder'=>'Faça uma breve descrição do seu produto.'];
			$this->form[] = ['label'=>'Foto','name'=>'img','type'=>'upload','width'=>'col-sm-5'];
			

			

			

			$this->form[] = ['label'=>'Codigo','name'=>'codigo','type'=>'hidden','width'=>'col-sm-10','value'=>'000000'];
			
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Nome','name'=>'nome','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Valor','name'=>'valor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Categoria','name'=>'categoria','type'=>'select2','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Q','validation'=>'required','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Barcode','name'=>'barcode','type'=>'hidden','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'UserID','name'=>'user_id','type'=>'hidden','width'=>'col-sm-10'];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();

	        

	       



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = "
				


				$( '#valor' ).keyup(function() {

 				 var val = document.getElementById('valor').value;

 				 document.getElementById('valor').value = val.replace(/,/g, '.');

 				 

				});

				


				
				
					 




	        ";


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }

	     


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        
	    	
	        $userID=CRUDBooster::myId();

	        if(CRUDBooster::myPrivilegeName()	== 'Colabers'){

	        	$query->where('user_id',$userID);

	        }

	        
	    	
	    		
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        	
	        	
	        	

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */

	    public function codigo()
    	{

            $exists = 1;


            while($exists > 0){

                $unique_code = mt_rand(0000, 9999); // better than rand()
                $unique_code = str_pad($unique_code, 7, "0", STR_PAD_LEFT);
                $exists = Produtos::where('codigo', $unique_code)->count();

                if($exists > 0){

                    $exists = 1;
                }
                else
                {	

                    return $unique_code;
                }

                
            }
   		 }


	    public function hook_after_add($id) {        
	        //Your code here

	    	

	    	$produto = Produtos::where('id',$id)
	    				->update(['codigo' => $this->codigo()]);
	    				
	    	
	     }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	       
				

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        




	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	 	  

	

	}

