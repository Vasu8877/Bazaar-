<?php

namespace Bazaar\DevVASU;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;
use pocketmine\Server;

use pocketmine\item\VanillaItems;
use pocketmine\block\VanillaBlocks;

use pocketmine\utils\TextFormat as TF;

use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelEventPacket;

use onebone\economyapi\EconomyAPI;

use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\world\format\io\GlobalItemDataHandlers;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;

class Bazaar extends PluginBase implements Listener {

    /** @var EconomyAPI|null */
    private ?EconomyAPI $eco = null;

    public function onEnable(): void {
        $this->getLogger()->info("AdvancedBazaarGUI By BhawaniSingh Enabled ✅");

        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        if (!$this->eco instanceof EconomyAPI) {
            $this->getLogger()->warning("EconomyAPI not found or incompatible.");
        }

        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
        if ($cmd->getName() === "bazaar") {
            if (!$sender->hasPermission("bazaar.use")) {
                $sender->sendMessage("§cYou don't have permission to use this command.");
                return true;
            }

            if ($sender instanceof Player) {
                $this->bazaar($sender);
            } else {
                $sender->sendMessage("§cUse this command in-game.");
            }
        }
        return true;
    }


   /* private function openBazaarMenu(Player $player): void {
        // Placeholder for your bazaar GUI logic
        $player->sendMessage("§aOpening Bazaar GUI...");
    }*/

  
  public function bazaar($player) {
  $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
  $inv = $menu->getInventory();

    $menu->readonly();
    $menu->setName("§l§6BAZAAR ➪ MINERALS");
    for($i = 0; $i < 54; $i++){
		if(!in_array($i, [])){
			$inv->setItem($i, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 3, 1, null))->setCustomName("§r §7 §r"));
        }
    }
    $inv->setItem(0, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(264, 0, 1, null))->setCustomName("§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products"));
    $inv->setItem(9, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(296, 0, 1, null))->setCustomName("§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(18, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(258, 0, 1, null))->setCustomName("§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(27, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(367, 0, 1, null))->setCustomName("§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products"));
    $inv->setItem(36, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(116, 0, 1, null))->setCustomName("§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products"));
    $inv->setItem(45, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(400, 0, 1, null))->setCustomName("§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products"));
    $inv->setItem(49, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(41, 0, 1, null))->setCustomName("§r§l§eSELL ITEMS\n\n§r§l§6Click To Open"));
    $inv->setItem(50, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(166, 0, 1, null))->setCustomName("§r§cCLOSE"));
    $inv->setItem(53, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(266, 0, 1, null))->setCustomName("§r§l§eBID ITEMS\n\n§r§l§6Click To Open"));
    $inv->setItem(42, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 15, 1, null))->setCustomName("§r§eSOON"));
   $items = [
        11 => ["id" => 263, "meta" => 0, "count" => 8, "name" => "COAL", "price" => 50],
        12 => ["id" => 265, "meta" => 0, "count" => 8, "name" => "IRON INGOT", "price" => 100],
        13 => ["id" => 266, "meta" => 0, "count" => 8, "name" => "GOLD INGOT", "price" => 150],
        14 => ["id" => 331, "meta" => 0, "count" => 8, "name" => "REDSTONE DUST", "price" => 50],
        15 => ["id" => 351, "meta" => 4, "count" => 8, "name" => "LAPIS LAZULI", "price" => 50],
        16 => ["id" => 264, "meta" => 0, "count" => 8, "name" => "DIAMOND", "price" => 250],
        20 => ["id" => 388, "meta" => 0, "count" => 8, "name" => "EMERALD", "price" => 500],
        21 => ["id" => 16, "meta" => 0, "count" => 8, "name" => "COAL ORE", "price" => 70],
        22 => ["id" => 15, "meta" => 0, "count" => 8, "name" => "IRON ORE", "price" => 120],
        23 => ["id" => 14, "meta" => 0, "count" => 8, "name" => "GOLD ORE", "price" => 170],
        24 => ["id" => 73, "meta" => 0, "count" => 8, "name" => "REDSTONE ORE", "price" => 70],
        25 => ["id" => 21, "meta" => 0, "count" => 8, "name" => "LAPIS ORE", "price" => 70],
        29 => ["id" => 56, "meta" => 0, "count" => 8, "name" => "DIAMOND ORE", "price" => 270],
        30 => ["id" => 129, "meta" => 0, "count" => 8, "name" => "EMERALD ORE", "price" => 520],
        31 => ["id" => 173, "meta" => 0, "count" => 8, "name" => "COAL BLOCK", "price" => 450],
        32 => ["id" => 42, "meta" => 0, "count" => 8, "name" => "IRON BLOCK", "price" => 900],
        33 => ["id" => 41, "meta" => 0, "count" => 8, "name" => "GOLD BLOCK", "price" => 1350],
        34 => ["id" => 152, "meta" => 0, "count" => 8, "name" => "REDSTONE BLOCK", "price" => 450],
        38 => ["id" => 22, "meta" => 0, "count" => 8, "name" => "LAPIS BLOCK", "price" => 450],
        39 => ["id" => 57, "meta" => 0, "count" => 8, "name" => "DIAMOND BLOCK", "price" => 2250],
        40 => ["id" => 133, "meta" => 0, "count" => 8, "name" => "EMERALD BLOCK", "price" => 4500],
    ];

    // Populate GUI
    foreach ($items as $slot => $data) {
    $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
        GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(
            $data["id"], $data["meta"], $data["count"], null
        ));

    $item->setCustomName(
        "§r§l§e{$data['name']}\n\n§r§bInformation:\n§r§6Price: §l§a⛃ §c{$data['price']}$\n§r§9Category: §r§2■ §dMINERALS\n\n§r§l§dClick To Purchase");

    $inv->setItem($slot, $item);

    }
    $inv->setItem(41, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 15, 1, null))->setCustomName("§r§eSOON"));
    $inv->setItem(43, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 15, 1, null))->setCustomName("§r§eSOON"));
    $menu->setListener(\Closure::fromCallable([$this, "MainMenu"]));
    $menu->send($player);
		return true;
	}
	
	public function MainMenu(InvMenuTransaction $transaction) : InvMenuTransactionResult{
		$item = $transaction->getItem();
		$player = $transaction->getPlayer();
		 $items = [
        11 => ["id" => 263, "meta" => 0, "count" => 8, "name" => "COAL", "price" => 50],
        12 => ["id" => 265, "meta" => 0, "count" => 8, "name" => "IRON INGOT", "price" => 100],
        13 => ["id" => 266, "meta" => 0, "count" => 8, "name" => "GOLD INGOT", "price" => 150],
        14 => ["id" => 331, "meta" => 0, "count" => 8, "name" => "REDSTONE DUST", "price" => 50],
        15 => ["id" => 351, "meta" => 4, "count" => 8, "name" => "LAPIS LAZULI", "price" => 50],
        16 => ["id" => 264, "meta" => 0, "count" => 8, "name" => "DIAMOND", "price" => 250],
        20 => ["id" => 388, "meta" => 0, "count" => 8, "name" => "EMERALD", "price" => 500],
        21 => ["id" => 16, "meta" => 0, "count" => 8, "name" => "COAL ORE", "price" => 70],
        22 => ["id" => 15, "meta" => 0, "count" => 8, "name" => "IRON ORE", "price" => 120],
        23 => ["id" => 14, "meta" => 0, "count" => 8, "name" => "GOLD ORE", "price" => 170],
        24 => ["id" => 73, "meta" => 0, "count" => 8, "name" => "REDSTONE ORE", "price" => 70],
        25 => ["id" => 21, "meta" => 0, "count" => 8, "name" => "LAPIS ORE", "price" => 70],
        29 => ["id" => 56, "meta" => 0, "count" => 8, "name" => "DIAMOND ORE", "price" => 270],
        30 => ["id" => 129, "meta" => 0, "count" => 8, "name" => "EMERALD ORE", "price" => 520],
        31 => ["id" => 173, "meta" => 0, "count" => 8, "name" => "COAL BLOCK", "price" => 450],
        32 => ["id" => 42, "meta" => 0, "count" => 8, "name" => "IRON BLOCK", "price" => 900],
        33 => ["id" => 41, "meta" => 0, "count" => 8, "name" => "GOLD BLOCK", "price" => 1350],
        34 => ["id" => 152, "meta" => 0, "count" => 8, "name" => "REDSTONE BLOCK", "price" => 450],
        38 => ["id" => 22, "meta" => 0, "count" => 8, "name" => "LAPIS BLOCK", "price" => 450],
        39 => ["id" => 57, "meta" => 0, "count" => 8, "name" => "DIAMOND BLOCK", "price" => 2250],
        40 => ["id" => 133, "meta" => 0, "count" => 8, "name" => "EMERALD BLOCK", "price" => 4500],
    ];
    if($item->getCustomName() == "§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->bazaar($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->farming($player);
			});
		}
		if($item->getCustomName() == "§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->lumberjack($player);
			});
		}
		if($item->getCustomName() == "§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->enchanting($player);
			});
		}
		if($item->getCustomName() == "§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->combat($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->others($player);
			});
		}
		if($item->getCustomName() == "§r§l§eBID ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			$this->getServer()->dispatchCommand($player, "ah");
			});
		}
		if($item->getCustomName() == "§r§l§eSELL ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->sell($player);
			});
		}
		if($item->getCustomName() == "§r§cCLOSE"&& $item->getDamage() == 0){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			});
		}
		$slot = $tx->getAction()->getSlot();

        if (isset($items[$slot])) {
            $data = $items[$slot];
            $price = $data["price"];
            $itemName = $data["name"];

            $money = EconomyAPI::getInstance()->myMoney($player);

            if ($money >= $price) {
                EconomyAPI::getInstance()->reduceMoney($player, $price);

                // Generate item WITHOUT custom name
                $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
                    GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
                );

                $player->getInventory()->addItem($item);
                $player->sendMessage("§aYou purchased §e{$itemName} §afor §c{$price}$");
            } else {
                $player->sendMessage("§cYou don't have enough money to buy §e{$itemName}!");
            }
        }

        return $tx->discard(); // Prevent item from being taken from GUI
    }
	 
public function farming($player) {
  $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
    $menu->readonly();
    $menu->setName("§l§6BAZAAR ➪ FARMING");
	$inv = $menu->getInventory();
    for($i = 0; $i < 54; $i++){
		if(!in_array($i, [])){
			$inv->setItem($i, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 3, 1, null))->setCustomName("§r §7 §r"));	 
        }
    }
    $inv->setItem(0, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(264, 0, 1, null))->setCustomName("§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products"));
    $inv->setItem(9, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(296, 0, 1, null))->setCustomName("§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(18, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(258, 0, 1, null))->setCustomName("§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(27, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(367, 0, 1, null))->setCustomName("§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products"));
    $inv->setItem(36, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(116, 0, 1, null))->setCustomName("§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products"));
    $inv->setItem(45, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(400, 0, 1, null))->setCustomName("§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products"));
    $inv->setItem(49, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(410, 0, 1, null))->setCustomName("§r§l§eSELL ITEMS\n\n§r§l§6Click To Open"));
    $inv->setItem(50, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(166, 0, 1, null))->setCustomName("§r§cCLOSE"));
    $inv->setItem(53, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(266, 0, 1, null))->setCustomName("§r§l§eBID ITEMS\n\n§r§l§6Click To Open"));
$items = [
        11 => ["id" => 296, "meta" => 0, "count" => 8, "name" => "WHEAT", "price" => 50],
        12 => ["id" => 391, "meta" => 0, "count" => 8, "name" => "CARROT", "price" => 50],
        13 => ["id" => 392, "meta" => 0, "count" => 8, "name" => "POTATO", "price" => 50],
        14 => ["id" => 260, "meta" => 0, "count" => 8, "name" => "APPLE", "price" => 50],
        15 => ["id" => 400, "meta" => 0, "count" => 8, "name" => "PUMPKIN PIE", "price" => 100],
        16 => ["id" => 360, "meta" => 0, "count" => 8, "name" => "MELON", "price" => 50],
        20 => ["id" => 354, "meta" => 0, "count" => 8, "name" => "CAKE", "price" => 250],
        21 => ["id" => 357, "meta" => 0, "count" => 8, "name" => "COOKIE", "price" => 50],
        22 => ["id" => 338, "meta" => 0, "count" => 8, "name" => "SUGARCANE", "price" => 50],
        23 => ["id" => 464, "meta" => 0, "count" => 8, "name" => "DRIED KELP", "price" => 50],
        24 => ["id" => 103, "meta" => 0, "count" => 8, "name" => "MELON BLOCK", "price" => 100],
        25 => ["id" => 86, "meta" => 0, "count" => 8, "name" => "PUMPKIN", "price" => 100],
        29 => ["id" => 170, "meta" => 0, "count" => 8, "name" => "HAY BLOCK", "price" => 100],
        30 => ["id" => 99, "meta" => 14, "count" => 8, "name" => "BROWN MUSHROOM BLOCK", "price" => 100],
        31 => ["id" => 100, "meta" => 14, "count" => 8, "name" => "RED MUSHROOM BLOCK", "price" => 100],
        32 => ["id" => 39, "meta" => 0, "count" => 8, "name" => "BROWN MUSHROOM", "price" => 50],
        33 => ["id" => 40, "meta" => 0, "count" => 8, "name" => "RED MUSHROOM", "price" => 50],
        34 => ["id" => 81, "meta" => 0, "count" => 8, "name" => "CACTUS", "price" => 50],
    ];

    foreach ($items as $slot => $data) {
        $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
            GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
        )->setCustomName("§r§l§e{$data['name']}\n\n§r§bInformation:\n§r§6Price: §l§a⛃ §c{$data['price']}$\n§r§9Category: §r§2■ §dFARMING\n\n§r§l§dClick To Purchase");

        $inv->setItem($slot, $item);
    }

    $menu->setListener(\Closure::fromCallable([$this, "FarmMenu"]));
    $menu->send($player);
		return true;
	}
	
	public function FarmMenu(InvMenuTransaction $transaction) : InvMenuTransactionResult{
		$item = $transaction->getItem();
		$player = $transaction->getPlayer();
		$items = [
        11 => ["id" => 296, "meta" => 0, "count" => 8, "name" => "WHEAT", "price" => 50],
        12 => ["id" => 391, "meta" => 0, "count" => 8, "name" => "CARROT", "price" => 50],
        13 => ["id" => 392, "meta" => 0, "count" => 8, "name" => "POTATO", "price" => 50],
        14 => ["id" => 260, "meta" => 0, "count" => 8, "name" => "APPLE", "price" => 50],
        15 => ["id" => 400, "meta" => 0, "count" => 8, "name" => "PUMPKIN PIE", "price" => 100],
        16 => ["id" => 360, "meta" => 0, "count" => 8, "name" => "MELON", "price" => 50],
        20 => ["id" => 354, "meta" => 0, "count" => 8, "name" => "CAKE", "price" => 250],
        21 => ["id" => 357, "meta" => 0, "count" => 8, "name" => "COOKIE", "price" => 50],
        22 => ["id" => 338, "meta" => 0, "count" => 8, "name" => "SUGARCANE", "price" => 50],
        23 => ["id" => 464, "meta" => 0, "count" => 8, "name" => "DRIED KELP", "price" => 50],
        24 => ["id" => 103, "meta" => 0, "count" => 8, "name" => "MELON BLOCK", "price" => 100],
        25 => ["id" => 86, "meta" => 0, "count" => 8, "name" => "PUMPKIN", "price" => 100],
        29 => ["id" => 170, "meta" => 0, "count" => 8, "name" => "HAY BLOCK", "price" => 100],
        30 => ["id" => 99, "meta" => 14, "count" => 8, "name" => "BROWN MUSHROOM BLOCK", "price" => 100],
        31 => ["id" => 100, "meta" => 14, "count" => 8, "name" => "RED MUSHROOM BLOCK", "price" => 100],
        32 => ["id" => 39, "meta" => 0, "count" => 8, "name" => "BROWN MUSHROOM", "price" => 50],
        33 => ["id" => 40, "meta" => 0, "count" => 8, "name" => "RED MUSHROOM", "price" => 50],
        34 => ["id" => 81, "meta" => 0, "count" => 8, "name" => "CACTUS", "price" => 50],
    ];
    if($item->getCustomName() == "§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->bazaar($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->farming($player);
			});
		}
		if($item->getCustomName() == "§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->lumberjack($player);
			});
		}
		if($item->getCustomName() == "§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->enchanting($player);
			});
		}
		if($item->getCustomName() == "§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->combat($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->others($player);
			});
		}
		if($item->getCustomName() == "§r§l§eBID ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			$this->getServer()->dispatchCommand($player, "ah");
			});
		}
		if($item->getCustomName() == "§r§l§eSELL ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->sell($player);
			});
		}
		if($item->getCustomName() == "§r§cCLOSE"&& $item->getDamage() == 0){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			});

		}
		$slot = $tx->getAction()->getSlot();

        if (isset($items[$slot])) {
            $data = $items[$slot];
            $price = $data["price"];
            $itemName = $data["name"];
            $money = EconomyAPI::getInstance()->myMoney($player);

            if ($money >= $price) {
                EconomyAPI::getInstance()->reduceMoney($player, $price);

                $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
                    GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
                );

                $player->getInventory()->addItem($item);
                $player->sendMessage("§aYou purchased §e{$itemName} §afor §c{$price}$");
            } else {
                $player->sendMessage("§cYou don't have enough money to buy §e{$itemName}!");
            }
        }        return $transaction->discard();
	 }
	 
	 public function sell($player) {
	 $menu = InvMenu::create(InvMenu::TYPE_CHEST);
    $menu->readonly();
    $menu->setName("§l§6BAZAAR ➪ SELL MENU");
    for($i = 0; $i < 54; $i++){
		if(!in_array($i, [])){
			$inv->setItem($i, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 3, 1, null))->setCustomName("§r §7 §r"));
        }
    }
    $inv->setItem(11, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(413, 0, 1, null))->setCustomName("§r§l§eSELL HAND\n\n§r§7Click To Sell All Items In\n§r§7Your Hand For Get Money.\n\n§r§l§dClick To Sell"));
    $inv->setItem(13, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(265, 0, 1, null))->setCustomName("§r§l§eSELL ORES\n\n§r§7Click To Sell All Ores In Your\n§r§7Inventory For Get Money.\n\n§r§l§dClick To Sell"));
   $inv->setItem(15, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(54, 0, 1, null))->setCustomName("§r§l§eSELL INVENTORY\n\n§r§7Click To Sell All Items In\n§r§7Your Inventory For Get Money.\n\n§r§l§dClick To Sell"));
   $menu->setListener(\Closure::fromCallable([$this, "SellMenu"]));
    $menu->send($player);
		return true;
	}
	
	public function SellMenu(InvMenuTransaction $transaction) : InvMenuTransactionResult {
    $item = $transaction->getItem();
    $player = $transaction->getPlayer();

    if ($item->getCustomName() === "§r§l§eSELL HAND\n\n§r§7Click To Sell All Items In\n§r§7Your Hand For Get Money.\n\n§r§l§dClick To Sell") {
        $inv = $transaction->getAction()->getInventory();
        $inv->onClose($player);
        return $transaction->discard()->then(function(Player $player) : void {
            $this->getServer()->dispatchCommand($player, "sell hand");
        });
    }

    if ($item->getCustomName() === "§r§l§eSELL ORES\n\n§r§7Click To Sell All Ores In Your\n§r§7Inventory For Get Money.\n\n§r§l§dClick To Sell") {
        $inv = $transaction->getAction()->getInventory();
        $inv->onClose($player);
        return $transaction->discard()->then(function(Player $player) : void {
            $this->getServer()->dispatchCommand($player, "sell ores");
        });
    }

    if ($item->getCustomName() === "§r§l§eSELL INVENTORY\n\n§r§7Click To Sell All Items In\n§r§7Your Inventory For Get Money.\n\n§r§l§dClick To Sell") {
        $inv = $transaction->getAction()->getInventory();
        $inv->onClose($player);
        return $transaction->discard()->then(function(Player $player) : void {
            $this->getServer()->dispatchCommand($player, "sell inv");
        });
    }

    return $transaction->discard();
	
        }
	 public function lumberjack($player) {
	 $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
	 $inv = $menu->getInventory();
    $menu->readonly();
    $menu->setName("§l§6BAZAAR ➪ LUMBERJACK");
    for($i = 0; $i < 54; $i++){
		if(!in_array($i, [])){
			$inv->setItem($i, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 3, 1, null))->setCustomName("§r §7 §r"));
        }
    }
    $inv->setItem(0, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(264, 0, 1, null))->setCustomName("§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products"));
    $inv->setItem(9, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(296, 0, 1, null))->setCustomName("§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(18, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(258, 0, 1, null))->setCustomName("§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(27, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(367, 0, 1, null))->setCustomName("§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products"));
    $inv->setItem(36, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(116, 0, 1, null))->setCustomName("§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products"));
    $inv->setItem(45, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(400, 0, 1, null))->setCustomName("§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products"));
    $inv->setItem(49, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(410, 0, 1, null))->setCustomName("§r§l§eSELL ITEMS\n\n§r§l§6Click To Open"));
    $inv->setItem(50, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(166, 0, 1, null))->setCustomName("§r§cCLOSE"));
    $inv->setItem(53, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(266, 0, 1, null))->setCustomName("§r§l§eBID ITEMS\n\n§r§l§6Click To Open"));
    $items = [
        11 => ["id" => 17, "meta" => 0, "count" => 32, "name" => "OAK LOG", "price" => 1600],
        12 => ["id" => 17, "meta" => 1, "count" => 32, "name" => "SPRUCE LOG", "price" => 1600],
        13 => ["id" => 17, "meta" => 2, "count" => 32, "name" => "BIRCH LOG", "price" => 1600],
        14 => ["id" => 17, "meta" => 3, "count" => 32, "name" => "JUNGLE LOG", "price" => 1600],
        15 => ["id" => 162, "meta" => 0, "count" => 32, "name" => "ACACIA LOG", "price" => 1600],
        16 => ["id" => 162, "meta" => 1, "count" => 32, "name" => "DARK OAK LOG", "price" => 1600],
        20 => ["id" => 5, "meta" => 0, "count" => 32, "name" => "OAK PLANKS", "price" => 800],
        21 => ["id" => 5, "meta" => 1, "count" => 32, "name" => "SPRUCE PLANKS", "price" => 800],
        22 => ["id" => 5, "meta" => 2, "count" => 32, "name" => "BIRCH PLANKS", "price" => 800],
        23 => ["id" => 5, "meta" => 3, "count" => 32, "name" => "JUNGLE PLANKS", "price" => 800],
        24 => ["id" => 5, "meta" => 4, "count" => 32, "name" => "ACACIA PLANKS", "price" => 800],
        25 => ["id" => 5, "meta" => 0, "count" => 32, "name" => "DARK OAK PLANKS", "price" => 800],
        29 => ["id" => 18, "meta" => 0, "count" => 32, "name" => "OAK LEAVES", "price" => 160],
        30 => ["id" => 18, "meta" => 1, "count" => 32, "name" => "SPRUCE LEAVES", "price" => 160],
        31 => ["id" => 18, "meta" => 2, "count" => 32, "name" => "BIRCH LEAVES", "price" => 160],
        32 => ["id" => 18, "meta" => 3, "count" => 32, "name" => "JUNGLE LEAVES", "price" => 160],
        33 => ["id" => 161, "meta" => 0, "count" => 32, "name" => "ACACIA LEAVES", "price" => 160],
        34 => ["id" => 161, "meta" => 1, "count" => 32, "name" => "DARK OAK LEAVES", "price" => 160],
        38 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        39 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        40 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        41 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        42 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        43 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
    ];

    foreach ($items as $slot => $data) {
        $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
            GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
        )->setCustomName("§r§l§e{$data['name']}\n\n§r§bInformation:\n§r§6Price: §l§a⛃ §c{$data['price']}$\n§r§9Category: §r§2■ §dLUMBERJACK\n\n§r§l§dClick To Purchase");

        $inv->setItem($slot, $item);
    }
    $menu->setListener(\Closure::fromCallable([$this, "WoodMenu"]));
    $menu->send($player);
		return true;
	}
	
	public function WoodMenu(InvMenuTransaction $transaction) : InvMenuTransactionResult{
		$item = $transaction->getItem();
		$player = $transaction->getPlayer();
		$items = [
        11 => ["id" => 17, "meta" => 0, "count" => 32, "name" => "OAK LOG", "price" => 1600],
        12 => ["id" => 17, "meta" => 1, "count" => 32, "name" => "SPRUCE LOG", "price" => 1600],
        13 => ["id" => 17, "meta" => 2, "count" => 32, "name" => "BIRCH LOG", "price" => 1600],
        14 => ["id" => 17, "meta" => 3, "count" => 32, "name" => "JUNGLE LOG", "price" => 1600],
        15 => ["id" => 162, "meta" => 0, "count" => 32, "name" => "ACACIA LOG", "price" => 1600],
        16 => ["id" => 162, "meta" => 1, "count" => 32, "name" => "DARK OAK LOG", "price" => 1600],
        20 => ["id" => 5, "meta" => 0, "count" => 32, "name" => "OAK PLANKS", "price" => 800],
        21 => ["id" => 5, "meta" => 1, "count" => 32, "name" => "SPRUCE PLANKS", "price" => 800],
        22 => ["id" => 5, "meta" => 2, "count" => 32, "name" => "BIRCH PLANKS", "price" => 800],
        23 => ["id" => 5, "meta" => 3, "count" => 32, "name" => "JUNGLE PLANKS", "price" => 800],
        24 => ["id" => 5, "meta" => 4, "count" => 32, "name" => "ACACIA PLANKS", "price" => 800],
        25 => ["id" => 5, "meta" => 0, "count" => 32, "name" => "DARK OAK PLANKS", "price" => 800],
        29 => ["id" => 18, "meta" => 0, "count" => 32, "name" => "OAK LEAVES", "price" => 160],
        30 => ["id" => 18, "meta" => 1, "count" => 32, "name" => "SPRUCE LEAVES", "price" => 160],
        31 => ["id" => 18, "meta" => 2, "count" => 32, "name" => "BIRCH LEAVES", "price" => 160],
        32 => ["id" => 18, "meta" => 3, "count" => 32, "name" => "JUNGLE LEAVES", "price" => 160],
        33 => ["id" => 161, "meta" => 0, "count" => 32, "name" => "ACACIA LEAVES", "price" => 160],
        34 => ["id" => 161, "meta" => 1, "count" => 32, "name" => "DARK OAK LEAVES", "price" => 160],
      /*8 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        39 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        40 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        41 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        42 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        43 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],*/
    ];
    if($item->getCustomName() == "§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->bazaar($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->farming($player);
			});
		}
		if($item->getCustomName() == "§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->lumberjack($player);
			});
		}
		if($item->getCustomName() == "§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->enchanting($player);
			});
		}
		if($item->getCustomName() == "§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->combat($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->others($player);
			});
		}
		if($item->getCustomName() == "§r§l§eBID ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			$this->getServer()->dispatchCommand($player, "ah");
			});
		}
		if($item->getCustomName() == "§r§l§eSELL ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->sell($player);
			});
		}
		if($item->getCustomName() == "§r§cCLOSE"&& $item->getDamage() == 0){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			});

		}
		$slot = $tx->getAction()->getSlot();

        if (isset($items[$slot])) {
            $data = $items[$slot];
            $price = $data["price"];
            $itemName = $data["name"];
            $money = EconomyAPI::getInstance()->myMoney($player);

            if ($money >= $price) {
                EconomyAPI::getInstance()->reduceMoney($player, $price);

                $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
                    GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
                );

                $player->getInventory()->addItem($item);
                $player->sendMessage("§aYou purchased §e{$itemName} §afor §c{$price}$");
            } else {
                $player->sendMessage("§cYou don't have enough money to buy §e{$itemName}!");
            }
        }
		        return $transaction->discard();
	 }
	 
	 public function combat($player) {
	 $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
	 $inv = $menu->getInventory();
    $menu->readonly();
    $menu->setName("§l§6BAZAAR ➪ COMBAT");
    for($i = 0; $i < 54; $i++){
		if(!in_array($i, [])){
			$inv->setItem($i, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 3, 1, null))->setCustomName("§r §7 §r"));
        }
    }
    $inv->setItem(0, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(264, 0, 1, null))->setCustomName("§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products"));
    $inv->setItem(9, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(296, 0, 1, null))->setCustomName("§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(18, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(258, 0, 1, null))->setCustomName("§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(27, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(367, 0, 1, null))->setCustomName("§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products"));
    $inv->setItem(36, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(116, 0, 1, null))->setCustomName("§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products"));
    $inv->setItem(45, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(400, 0, 1, null))->setCustomName("§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products"));
    $inv->setItem(49, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(410, 0, 1, null))->setCustomName("§r§l§eSELL ITEMS\n\n§r§l§6Click To Open"));
    $inv->setItem(50, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(166, 0, 1, null))->setCustomName("§r§cCLOSE"));
    $inv->setItem(53, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(266, 0, 1, null))->setCustomName("§r§l§eBID ITEMS\n\n§r§l§6Click To Open"));
    $items = [
        11 => ["id" => 367, "meta" => 0, "count" => 8, "name" => "ROTTEN FLESH", "price" => 200],
        12 => ["id" => 352, "meta" => 0, "count" => 8, "name" => "BONE", "price" => 200],
        13 => ["id" => 289, "meta" => 0, "count" => 8, "name" => "GUN POWDER", "price" => 200],
        14 => ["id" => 368, "meta" => 0, "count" => 8, "name" => "ENDER PEARL", "price" => 200],
        15 => ["id" => 375, "meta" => 0, "count" => 8, "name" => "SPIDER EYE", "price" => 200],
        16 => ["id" => 287, "meta" => 0, "count" => 8, "name" => "STRING", "price" => 200],
        20 => ["id" => 334, "meta" => 0, "count" => 8, "name" => "LEATHER", "price" => 200],
        21 => ["id" => 344, "meta" => 0, "count" => 8, "name" => "EGG", "price" => 200],
        22 => ["id" => 415, "meta" => 0, "count" => 8, "name" => "RABBIT HIDE", "price" => 200],
        23 => ["id" => 414, "meta" => 0, "count" => 8, "name" => "RABBIT FOOT", "price" => 200],
        24 => ["id" => 288, "meta" => 0, "count" => 8, "name" => "FEATHER", "price" => 200],
        25 => ["id" => 351, "meta" => 0, "count" => 8, "name" => "INK SAC", "price" => 200],
        29 => ["id" => 341, "meta" => 0, "count" => 8, "name" => "SLIME BALL", "price" => 200],
        30 => ["id" => 378, "meta" => 0, "count" => 8, "name" => "MAGMA CREAM", "price" => 200],
        31 => ["id" => 370, "meta" => 0, "count" => 8, "name" => "GHAST TEAR", "price" => 200],
        32 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        33 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        34 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        38 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        39 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        40 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        41 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        42 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        43 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
    ];

    foreach ($items as $slot => $data) {
        $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
            GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
        )->setCustomName("§r§l§e{$data['name']}\n\n§r§bInformation:\n§r§6Price: §l§a⛃ §c{$data['price']}$\n§r§9Category: §r§2■ §dCOMBAT\n\n§r§l§dClick To Purchase");

        $inv->setItem($slot, $item);
		}
    $menu->setListener(\Closure::fromCallable([$this, "CombatMenu"]));
    $menu->send($player);
		return true;
	}
	
	public function CombatMenu(InvMenuTransaction $transaction) : InvMenuTransactionResult{
		$item = $transaction->getItem();
		$player = $transaction->getPlayer();
		$items = [
        11 => ["id" => 367, "meta" => 0, "count" => 8, "name" => "ROTTEN FLESH", "price" => 200],
        12 => ["id" => 352, "meta" => 0, "count" => 8, "name" => "BONE", "price" => 200],
        13 => ["id" => 289, "meta" => 0, "count" => 8, "name" => "GUN POWDER", "price" => 200],
        14 => ["id" => 368, "meta" => 0, "count" => 8, "name" => "ENDER PEARL", "price" => 200],
        15 => ["id" => 375, "meta" => 0, "count" => 8, "name" => "SPIDER EYE", "price" => 200],
        16 => ["id" => 287, "meta" => 0, "count" => 8, "name" => "STRING", "price" => 200],
        20 => ["id" => 334, "meta" => 0, "count" => 8, "name" => "LEATHER", "price" => 200],
        21 => ["id" => 344, "meta" => 0, "count" => 8, "name" => "EGG", "price" => 200],
        22 => ["id" => 415, "meta" => 0, "count" => 8, "name" => "RABBIT HIDE", "price" => 200],
        23 => ["id" => 414, "meta" => 0, "count" => 8, "name" => "RABBIT FOOT", "price" => 200],
        24 => ["id" => 288, "meta" => 0, "count" => 8, "name" => "FEATHER", "price" => 200],
        25 => ["id" => 351, "meta" => 0, "count" => 8, "name" => "INK SAC", "price" => 200],
        29 => ["id" => 341, "meta" => 0, "count" => 8, "name" => "SLIME BALL", "price" => 200],
        30 => ["id" => 378, "meta" => 0, "count" => 8, "name" => "MAGMA CREAM", "price" => 200],
        31 => ["id" => 370, "meta" => 0, "count" => 8, "name" => "GHAST TEAR", "price" => 200],
       /*2 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        33 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        34 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        38 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        39 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        40 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        41 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        42 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        43 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],*/
    ];
    if($item->getCustomName() == "§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->bazaar($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->farming($player);
			});
		}
		if($item->getCustomName() == "§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->lumberjack($player);
			});
		}
		if($item->getCustomName() == "§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->enchanting($player);
			});
		}
		if($item->getCustomName() == "§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->combat($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->others($player);
			});
		}
		if($item->getCustomName() == "§r§l§eBID ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			$this->getServer()->dispatchCommand($player, "ah");
			});
		}
		if($item->getCustomName() == "§r§l§eSELL ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->sell($player);
			});
		}
		if($item->getCustomName() == "§r§cCLOSE"&& $item->getDamage() == 0){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			});

		}
		$slot = $tx->getAction()->getSlot();

        if (isset($items[$slot])) {
            $data = $items[$slot];
            $price = $data["price"];
            $itemName = $data["name"];
            $money = EconomyAPI::getInstance()->myMoney($player);

            if ($money >= $price) {
                EconomyAPI::getInstance()->reduceMoney($player, $price);

                $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
                    GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
                );

                $player->getInventory()->addItem($item);
                $player->sendMessage("§aYou purchased §e{$itemName} §afor §c{$price}$");
            } else {
                $player->sendMessage("§cYou don't have enough money to buy §e{$itemName}!");
            }
        }

        return $transaction->discard();
	 }

public function enchanting($player) {
	 $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
	  $inv = $menu->getInventory();
    $menu->readonly();
    $menu->setName("§l§6BAZAAR ➪ENCHNTER");
    for($i = 0; $i < 54; $i++){
		if(!in_array($i, [])){
			$inv->setItem($i, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 3, 1, null))->setCustomName("§r §7 §r"));
        }
    }
   $inv->setItem(0, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(264, 0, 1, null))->setCustomName("§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products"));
    $inv->setItem(9, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(296, 0, 1, null))->setCustomName("§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(18, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(258, 0, 1, null))->setCustomName("§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(27, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(367, 0, 1, null))->setCustomName("§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products"));
    $inv->setItem(36, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(116, 0, 1, null))->setCustomName("§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products"));
    $inv->setItem(45, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(400, 0, 1, null))->setCustomName("§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products"));
    $inv->setItem(49, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(410, 0, 1, null))->setCustomName("§r§l§eSELL ITEMS\n\n§r§l§6Click To Open"));
    $inv->setItem(50, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(166, 0, 1, null))->setCustomName("§r§cCLOSE"));
    $inv->setItem(53, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(266, 0, 1, null))->setCustomName("§r§l§eBID ITEMS\n\n§r§l§6Click To Open"));
    $items = [
        11 => ["id" => 340, "meta" => 0, "count" => 8, "name" => "BOOK", "price" => 800],
        12 => ["id" => 384, "meta" => 0, "count" => 8, "name" => "EXPERIENCE BOTTLE", "price" => 800],
        13 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        14 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        15 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        16 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        20 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        21 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        22 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        23 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        24 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        25 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        29 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        30 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        31 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        32 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        33 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        34 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        38 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        39 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        40 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        41 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        42 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        43 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
    ];

    foreach ($items as $slot => $data) {
        $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
            GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
        )->setCustomName("§r§l§e{$data['name']}\n\n§r§bInformation:\n§r§6Price: §l§a⛃ §c{$data['price']}$\n§r§9Category: §r§2■ §dENCHANTER\n\n§r§l§dClick To Purchase");

        $inv->setItem($slot, $item);
    
	$menu->setListener(\Closure::fromCallable([$this, "EnchantMenu"]));
    $menu->send($player);
		return true;
	}
}
	
	public function EnchantMenu(InvMenuTransaction $transaction) : InvMenuTransactionResult{
		$item = $transaction->getItem();
		$player = $transaction->getPlayer();
		$items = [
        11 => ["id" => 340, "meta" => 0, "count" => 8, "name" => "BOOK", "price" => 800],
        12 => ["id" => 384, "meta" => 0, "count" => 8, "name" => "EXPERIENCE BOTTLE", "price" => 800],
       /*3 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        14 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        15 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        16 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        20 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        21 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        22 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        23 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        24 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        25 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        29 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        30 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        31 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        32 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        33 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        34 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        38 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        39 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        40 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        41 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        42 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        43 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],*/
    ];
    if($item->getCustomName() == "§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->bazaar($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->farming($player);
			});
		}
		if($item->getCustomName() == "§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->lumberjack($player);
			});
		}
		if($item->getCustomName() == "§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->enchanting($player);
			});
		}
		if($item->getCustomName() == "§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->combat($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->others($player);
			});
		}
		if($item->getCustomName() == "§r§l§eBID ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			$this->getServer()->dispatchCommand($player, "ah");
			});
		}
		if($item->getCustomName() == "§r§l§eSELL ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->sell($player);
			});
		}
		if($item->getCustomName() == "§r§cCLOSE"&& $item->getDamage() == 0){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			});

		}
		 $slot = $tx->getAction()->getSlot();

        if (isset($items[$slot])) {
            $data = $items[$slot];
            $price = $data["price"];
            $itemName = $data["name"];
            $money = EconomyAPI::getInstance()->myMoney($player);

            if ($money >= $price) {
                EconomyAPI::getInstance()->reduceMoney($player, $price);

                $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
                    GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
                );

                $player->getInventory()->addItem($item);
                $player->sendMessage("§aYou purchased §e{$itemName} §afor §c{$price}$");
            } else {
                $player->sendMessage("§cYou don't have enough money to buy §e{$itemName}!");
            }
        }

        return $transaction->discard();
	 }

public function others($player) {
	 $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
	 $inv = $menu->getInventory();
    $menu->readonly();
    $menu->setName("§l§6BAZAAR ➪ FOODS");
	for($i = 0; $i < 54; $i++){
		if(!in_array($i, [])){
			$inv->setItem($i, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(160, 3, 1, null))->setCustomName("§r §7 §r"));
        }
    }
   $inv->setItem(0, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(264, 0, 1, null))->setCustomName("§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products"));
    $inv->setItem(9, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(296, 0, 1, null))->setCustomName("§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(18, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(258, 0, 1, null))->setCustomName("§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products"));
    $inv->setItem(27, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(367, 0, 1, null))->setCustomName("§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products"));
    $inv->setItem(36, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(116, 0, 1, null))->setCustomName("§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products"));
    $inv->setItem(45, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(400, 0, 1, null))->setCustomName("§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products"));
    $inv->setItem(49, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(410, 0, 1, null))->setCustomName("§r§l§eSELL ITEMS\n\n§r§l§6Click To Open"));
    $inv->setItem(50, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(166, 0, 1, null))->setCustomName("§r§cCLOSE"));
    $inv->setItem(53, GlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt(266, 0, 1, null))->setCustomName("§r§l§eBID ITEMS\n\n§r§l§6Click To Open"));
    $items = [
        11 => ["id" => 365, "meta" => 0, "count" => 16, "name" => "RAW CHICKEN", "price" => 1000],
        12 => ["id" => 363, "meta" => 0, "count" => 16, "name" => "RAW BEEF", "price" => 1000],
        13 => ["id" => 319, "meta" => 0, "count" => 16, "name" => "RAW PORKCHOP", "price" => 1000],
        14 => ["id" => 423, "meta" => 0, "count" => 16, "name" => "RAW MUTTON", "price" => 1000],
        15 => ["id" => 366, "meta" => 0, "count" => 16, "name" => "COOKED CHICKEN", "price" => 1500],
        16 => ["id" => 364, "meta" => 0, "count" => 16, "name" => "COOKED BEEF", "price" => 1500],
        20 => ["id" => 320, "meta" => 0, "count" => 16, "name" => "COOKED PORKCHOP", "price" => 1500],
        21 => ["id" => 424, "meta" => 0, "count" => 16, "name" => "COOKED MUTTON", "price" => 1500],
        22 => ["id" => 297, "meta" => 0, "count" => 16, "name" => "BREAD", "price" => 1500],
        23 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        24 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        25 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        29 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        30 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        31 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        32 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        33 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        34 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        38 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        39 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        40 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        41 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        42 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        43 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
    ];

    foreach ($items as $slot => $data) {
        $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
            GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
        )->setCustomName("§r§l§e{$data['name']}\n\n§r§bInformation:\n§r§6Price: §l§a⛃ §c{$data['price']}$\n§r§9Category: §r§2■ §dFOODS\n\n§r§l§dClick To Purchase");

        $inv->setItem($slot, $item);
    
	$menu->setListener(\Closure::fromCallable([$this, "FoodsMenu"]));
    $menu->send($player);
		return true;
	}
}
	
	public function FoodsMenu(InvMenuTransaction $transaction) : InvMenuTransactionResult{
		$item = $transaction->getItem();
		$player = $transaction->getPlayer();
		$items = [
        11 => ["id" => 365, "meta" => 0, "count" => 16, "name" => "RAW CHICKEN", "price" => 1000],
        12 => ["id" => 363, "meta" => 0, "count" => 16, "name" => "RAW BEEF", "price" => 1000],
        13 => ["id" => 319, "meta" => 0, "count" => 16, "name" => "RAW PORKCHOP", "price" => 1000],
        14 => ["id" => 423, "meta" => 0, "count" => 16, "name" => "RAW MUTTON", "price" => 1000],
        15 => ["id" => 366, "meta" => 0, "count" => 16, "name" => "COOKED CHICKEN", "price" => 1500],
        16 => ["id" => 364, "meta" => 0, "count" => 16, "name" => "COOKED BEEF", "price" => 1500],
        20 => ["id" => 320, "meta" => 0, "count" => 16, "name" => "COOKED PORKCHOP", "price" => 1500],
        21 => ["id" => 424, "meta" => 0, "count" => 16, "name" => "COOKED MUTTON", "price" => 1500],
        22 => ["id" => 297, "meta" => 0, "count" => 16, "name" => "BREAD", "price" => 1500],
       /* => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        24 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        25 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        29 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        30 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        31 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        32 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        33 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        34 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        38 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        39 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        40 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        41 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        42 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],
        43 => ["id" => 160, "meta" => 15, "count" => 1, "name" => "SOON", "price" => 0],*/
    ];
    if($item->getCustomName() == "§r§l§eMINERALS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a21 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->bazaar($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFARMING\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->farming($player);
			});
		}
		if($item->getCustomName() == "§r§l§eLUMBERJACK\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a18 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->lumberjack($player);
			});
		}
		if($item->getCustomName() == "§r§l§eENCHANTER\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a2 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->enchanting($player);
			});
		}
		if($item->getCustomName() == "§r§l§eCOMBAT\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a15 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->combat($player);
			});
		}
		if($item->getCustomName() == "§r§l§eFOODS\n\n§r§l§6Click To Open\n\n§r§l§dTotal: §r§l§a9 Products" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->others($player);
			});
		}
		if($item->getCustomName() == "§r§l§eBID ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			$this->getServer()->dispatchCommand($player, "ah");
			});
		}
		if($item->getCustomName() == "§r§l§eSELL ITEMS\n\n§r§l§6Click To Open" && $item->getDamage() == 0 && $item->getCount() == 1){
			return $transaction->discard()->then(function(Player $player) : void{
			$this->sell($player);
			});
		}
		if($item->getCustomName() == "§r§cCLOSE"&& $item->getDamage() == 0){
        	$inv = $transaction->getAction()->getInventory();
			$inv->onClose($player);
			return $transaction->discard()->then(function(Player $player) : void{
			});

		}
		 $slot = $tx->getAction()->getSlot();

        if (isset($items[$slot])) {
            $data = $items[$slot];
            $price = $data["price"];
            $itemName = $data["name"];
            $money = EconomyAPI::getInstance()->myMoney($player);

            if ($money >= $price) {
                EconomyAPI::getInstance()->reduceMoney($player, $price);

                $item = GlobalItemDataHandlers::getDeserializer()->deserializeStack(
                    GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($data["id"], $data["meta"], $data["count"], null)
                );

                $player->getInventory()->addItem($item);
                $player->sendMessage("§aYou purchased §e{$itemName} §afor §c{$price}$");
            } else {
                $player->sendMessage("§cYou don't have enough money to buy §e{$itemName}!");
            }
        }
	
        return $transaction->discard();
	 }
}