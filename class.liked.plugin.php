<?php if (!defined('APPLICATION')) exit();

// Define the plugin:
$PluginInfo['Liked'] = array(
   'Name' => 'Liked',
   'Description' => 'Adds the facebook like feature to your discussions.',
   'Version' => '1.3',
   'Author' => "Gary Mardell",
   'AuthorEmail' => 'gary@vanillaplugins.com',
   'AuthorUrl' => 'http://garymardell.co.uk'
);

class LikedPlugin extends Gdn_Plugin {
	
	private $Code = '<div style="float: right; margin-top: 12px; z-index: 999; position: relative"><fb:like href="%s" layout="button_count" width="60" show_faces="false" font="lucida grande"></fb:like></div>';
	   
	public function DiscussionController_Render_Before(&$Sender) {
		$Sender->Head->AddTag('meta', array('content' => Gdn_Format::Text($Sender->Discussion->Name), 'property' => 'og:title'));
		$Sender->Head->AddTag('meta', array('content' => Gdn_Url::Request(true, true, true), 'property' => 'og:url'));
		$Sender->Head->AddTag('meta', array('content' => C('Garden.Title'), 'property' => 'og:site_name'));
		$Sender->Head->AddTag('meta', array('content' => 'article', 'property' => 'og:type'));
		$Sender->addJsFile('http://connect.facebook.net/fr_FR/all.js#xfbml=1');
	}
	
	public function DiscussionController_BeforeDiscussion_Handler(&$Sender) {
		echo sprintf($this->Code, Gdn_Url::Request(true, true, true));
	}

   public function Setup() {
      // No setup required.
   }
}

