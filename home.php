<!DOCTYPE html>
<html>
<head>
	<title>PostgreSQL Query Interface</title>
	<meta name="description" content="This is a Query Interface">
	<link rel="stylesheet" href="styles.css">
</head>
<body class="bodystyle">
		<header class="main-header mh">
				<img class="header-img" src="dspace-logo-only.png">
				<span class="header-title">Repository Query Interface</span>
		</header>
		<section class="content">
		<h2 class="search-title">Search or List items</h2>

		
	<form action="home.php" method="post">
		<select class="choice-class" name="stage-selection">
			<option value="NULL">Stage Select..</option>
			<option value="1">Community/Sub-Community</option>
			<option value="2">Collection</option>
			<option value="3">All of Dspace</option>
			<option value="4">Items Harvested Between</option>
		</select>
			<input type="text" class="choicewidth" name="stage-id" placeholder="Enter Corresponding Stage ID/Harvest Date">&nbsp&nbsp&nbsp			     <input type="text" class="choicewidth" name="hvt_date" placeholder="Enter 2nd harvest date iff applicable">&nbsp&nbsp&nbsp		<input type="text" class="choicewidth" name="filename" placeholder="Enter Filename to Export to..">


		<input type="submit" class="submit" name="submitt">

	<br>
	
	</form>
		<a href="home.php"><button type="button" class="refresh">Clear Page</button></a>

	<br>
	<br>
	<br>

	
<?php
	

	//	print_r($data[0]);
		//($data[$i]["metadata_field_id"]);

	//print_r($data);

				/*echo "<tr>";
					for($i=0;$i<4)//count($data);)
					{	
						$x=$data[$i]['resource_id'];
						$headervalue=$_POST["title"]
						if($data[$i]['metadata_field_id']==$headervalue)
							echo "<td align='center' width='400'>".$data[$i]['text_value']."</td>"; 
						else{
							echo "<td></td>";
							$i--;
						}
						$i++;
						//echo "</td>";
						if($data[$i]['resource_id']!=$x)
						{
						echo "</tr>";
						echo "<tr>";
						}
					}*/


		class Md{
			public $title="";
			public $genre="";
			public $uri="";
			public $accessioned="";
			public $available="";
			public $provenance="";
			public $author="";
			public $issued="";
			public $other="";
			public $description="";
			public $abstract="";
			public $iso="";
			public $part_of_series="";
			public $index_term="";
			public $harvested_source="";

			public function __construct($args){
				$this->title=$args[64];
				$this->genre=$args[66];
				$this->uri=$args[25];
				$this->accessioned=$args[11];
				$this->available=$args[12];
				$this->provenance=$args[28];
				$this->author=$args[3];
				$this->issued=$args[15];
				$this->other=$args[24];
				$this->description=$args[26];
				$this->abstract=$args[27];
				$this->iso=$args[38];
				$this->part_of_series=$args[43];
				$this->index_term=$args[57];
				$this->harvested_source=$args[55];
			}
			
			public function print(){
				echo "<td style='padding:30px' align='center' width='800'>$this->title</td>";
				echo "<td align='center' width='800'>$this->genre</td>";
				echo "<td align='center' width='800'>$this->uri</td>";
				echo "<td align='center' width='800'>$this->accessioned</td>";
				echo "<td align='center' width='800'>$this->available</td>";
				echo "<td align='center' width='800'>$this->provenance</td>";
				echo "<td align='center' width='800'>$this->author</td>";
				echo "<td align='center' width='800'>$this->issued</td>";
				echo "<td align='center' width='800'>$this->other</td>";
				echo "<td align='center' width='800'>$this->description</td>";
				echo "<td align='center' width='800'>$this->abstract</td>";
				echo "<td align='center' width='800'>$this->iso</td>";
				echo "<td align='center' width='800'>$this->part_of_series</td>";
				echo "<td align='center' width='800'>$this->index_term</td>";
				echo "<td align='center' width='800'>$this->harvested_source</td>";
			}


		}



		
		//echo count($data);
	/*for($i=0;$i<100;$i++){
		for($j=0;$j<count($data);$j++)
		{
			echo $data[$i]['text_value'];
		}
	}*/	/*for($i=0;$i<count($data);)
		{	
			$x=$data[$i]['resource_id'];
			echo $data[$i]['text_value']; echo "&nbsp;&nbsp"; 
			$i++;
			if($data[$i]['resource_id']!=$x)
			{
				echo "<br>";
			}
		}	*/
		
		
		//echo $data[20]['text_value'];
		//echo $data[20]['resource_id'];


if(isset($_POST['submitt']))
{

		$stage=$_POST["stage-selection"];
		$id=$_POST["stage-id"];
		$hvt=$_POST["hvt_date"];
		$fname=$_POST["filename"];
		//echo $fname;
		//echo "$hvt";
		//echo "$id";
		echo "<strong>&nbsp;&nbsp;&nbsp;&nbsp;Results for your query are as follows : </strong>";
		echo "<br>";
		echo "<br>";
		echo "<br>";

		if($stage==3){
		
			$db = pg_connect("host=localhost dbname=restore user=dspace password=dspace123");
			$data=array();
			$result = pg_query($db,"SELECT resource_id , text_value, metadata_field_id FROM collection2item ci, metadatavalue WHERE ci.item_id=metadatavalue.resource_id ORDER BY resource_id ");



			while($row=pg_fetch_assoc($result)){
				$data[]=$row;
			}
			//$filename='Lala.csv';
			$file=fopen($fname,'a');
			foreach ($data as $key => $value) {
				# code...
				fputcsv($file,$value);
			}
			fclose($file);
			echo "<table  border=10px>";
			   		echo "<th ><u>Item ID</u></th>";
			   		echo "<th ><u>Title</u></th>";
			   		echo "<th ><u>Genre</u></th>";
			   		echo "<th ><u>URI</u></th>";
			   		echo "<th ><u>Accessioned</u></th>";
			   		echo "<th ><u>Available</u></th>";
			   		echo "<th ><u>Provenance</u></th>";
			   		echo "<th ><u>Author</u></th>";
			   		echo "<th ><u>Issued</u></th>";
			   		echo "<th ><u>Other</u></th>";
			   		echo "<th ><u>Description</u></th>";
			   		echo "<th ><u>Abstract</u></th>";
			   		echo "<th ><u>ISO</u></th>";
			   		echo "<th ><u>Part of Series</u></th>";
			   		echo "<th ><u>Index of Term</u></th>";
			   		echo "<th ><u>Harvested Source</u></th>";
					$global=array();
			
					echo "<tr>";
					echo "<td align='center'>".$data[0]['resource_id']."</td>";				
					for($i=0;$i<84;)
					{	
						$x=$data[$i]['resource_id'];
						$global[$data[$i]["metadata_field_id"]]=$data[$i]["text_value"];
		
						$i++;
						if($data[$i]['resource_id']!=$x)
						{
							$metadata= new Md($global);
							$metadata->print();
							echo "</tr>";
						
							echo "<tr>";
							echo "<td align='center' width='800'>".$data[$i]['resource_id']."</td>";
							unset($metadata);
							unset($global);
							$global=array();

						}
					}
			echo "</table";
			
		/*function str_putcsv($data) {
        # Generate CSV data from array
        $fh = fopen('php://temp', 'rw'); # don't create a file, attempt
                                         # to use memory instead

        # write out the headers
        fputcsv($fh, array_keys(current($data)));

        # write out the data
        foreach ( $data as $row ) {
                fputcsv($fh, $row);
        }
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);

        return $csv;
		}*/

		//echo "<input type="submit">";


		/*$servername = "localhost";
		$username = "dspace";
		$password = "dspace123";
		$dbname = "dspace";

		$conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT resource_id , text_value, metadata_field_id FROM collection2item ci, metadatavalue WHERE ci.item_id=metadatavalue.resource_id ORDER BY resource_id"); 
		$stmt->execute();

		$filename = 'test_postgres.csv';

		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename=' . $filename);
		header("Content-Transfer-Encoding: UTF-8");

		$head = fopen($filename, 'w');

		$headers = $stmt->fetch(PDO::FETCH_ASSOC);
		fputcsv($head, array_keys($headers));

		fclose($head);
		
		$data = fopen($filename, 'a');
		fputcsv($data, $headers);

		    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		        fputcsv($data, $row);
		    }
		fclose($data);*/
		/*function array2csv($data, $delimiter = ',', $enclosure = '"', $escape_char = "\\")
						{
						    $f = fopen('php://memory', 'r+');
						    foreach ($data as $item) {
						        fputcsv($f, $item, $delimiter, $enclosure, $escape_char);
						    }
						    rewind($f);
						    return stream_get_contents($f);
						}

		
		//var_dump(array2csv($list));*/



		}

		elseif ($stage==1) {
			$db = pg_connect("host=localhost dbname=restore user=dspace password=dspace123");
			$result = pg_query($db,"SELECT text_value, community_id, item_id FROM metadatavalue md, communities2item ci WHERE md.metadata_field_id=64 and md.resource_type_id=4 and md.resource_id=ci.community_id and md.resource_id=$id");
			
			echo "<table border=10 >";
				echo "<th><u>Community Name</u></th>";
                echo "<th ><u>Community ID</u></th>";
                echo "<th><u>Item ID</u></th>";
            echo "</tr>";
			while($row=pg_fetch_assoc($result)){echo "<tr>";
			echo "<td align='center' width='600'>" . $row['text_value'] . "</td>";
			echo "<td align='center' width='200'>" . $row['community_id'] . "</td>";
			echo "<td align='center' width='200'>" . $row['item_id'] . "</td>";
			echo "</tr>";}echo "</table>";

		
			$result = pg_query($db,"SELECT text_value, community_id, item_id FROM metadatavalue md, communities2item ci WHERE md.metadata_field_id=64 and md.resource_type_id=4 and md.resource_id=ci.community_id and md.resource_id=$id");
			while($row=pg_fetch_assoc($result)){
				$data[]=$row;
			}
			$file=fopen($fname,'a');
			foreach ($data as $key => $value) {
				fputcsv($file,$value);
			}
			fclose($file);
		
		}
		elseif ($stage==2) {
			$db = pg_connect("host=localhost dbname=dspace user=dspace password=dspace123");
			$result = pg_query($db,"SELECT text_value, collection_id, item_id FROM  metadatavalue md, collection2item ci WHERE  md.metadata_field_id=64 and md.resource_type_id=3 and md.resource_id=ci.collection_id and md.resource_id=$id");


			echo "<table border=10>";
				echo "<th><u>Collection Name</u></th>";
			    echo "<th ><u>Collection ID</u></th>";
                echo "<th><u>Item ID</u></th>";

			while($row=pg_fetch_assoc($result)){echo "<tr>";
			echo "<td align='center' width='600'>" . $row['text_value'] . "</td>";
			echo "<td align='center' width='200'>" . $row['collection_id'] . "</td>";
			echo "<td align='center' width='200'>" . $row['item_id'] . "</td>";
			echo "</tr>";}	echo "</table>";


			$result = pg_query($db,"SELECT text_value, collection_id, item_id FROM  metadatavalue md, collection2item ci WHERE  md.metadata_field_id=64 and md.resource_type_id=3 and md.resource_id=ci.collection_id and md.resource_id=$id");
			while($row=pg_fetch_assoc($result)){
				$data[]=$row;
			}
			
			$file=fopen($fname,'a');
			foreach ($data as $key => $value) {
				# code...
				fputcsv($file,$value);
			}
			fclose($file);

			echo '</table>';

			
		}

		elseif ($stage==4) {
			$db = pg_connect("host=localhost dbname=restore user=dspace password=dspace123");
			$result = pg_query($db,"SELECT last_harvested, item_id FROM harvested_item WHERE last_harvested between '$id' 	and '$hvt'");

			/*$data=array();
			while($row=pg_fetch_assoc($result)){
				$data[]=$row;
			}

			print_r($data);*/

			echo "<table border=10 >";
				echo "<th><u>Harvested Date</u></th>";
                echo "<th ><u>Item ID</u></th>";
               //echo "<th><u>Item ID</u></th>";
            echo "</tr>";
			while($row=pg_fetch_assoc($result)){echo "<tr>";
			echo "<td align='center' width='600'>" . $row['last_harvested'] . "</td>";
			echo "<td align='center' width='200'>" . $row['item_id'] . "</td>";
			//echo "<td align='center' width='200'>" . $row['item_id'] . "</td>";
			echo "</tr>";}echo "</table>";

			$result = pg_query($db,"SELECT last_harvested, item_id FROM harvested_item WHERE last_harvested between '$id' 	and '$hvt'");
			while($row=pg_fetch_assoc($result)){
				$data[]=$row;
			}
			$file=fopen($fname,'a');
			foreach ($data as $key => $value) {
				# code...
				fputcsv($file,$value);
			}
			fclose($file);
		
		}
		
		else{
			echo "Invalid Selection! Please Recheck! ";
		}

}


?>
	</table>
	</section>
	</body>
</html>
