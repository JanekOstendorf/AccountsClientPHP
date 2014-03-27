AccountsClientPHP
=================

This is a PHP implementation of Mojang's [AccountsClient](https://github.com/Mojang/AccountsClient) for Minecraft. It uses Mojangs public API to convert **player names -> UUID**. Converting UUIDs to player names is not supported by Mojang yet.

A real documentation does not exist (yet). Mojang's Java client isn't documentated either. I had a pretty hard time to get through the code and the JSON-API.

## Example
```php
/*
 * Example of a simple function
 */

function minecraftNameToID($minecraftName) {
	$profileRepo = new \AccountsClientPHP\HTTPProfileRepository();
	$criteria = new \AccountsClientPHP\ProfileCriteria($minecraftName, 'minecraft');
	return $profileRepo->findProfilesByCriteria($criteria)[0]->getName();
}

var_dump(minecraftNameToID('ozzy2345')); // c709e602680b40459dbe00e47f3f4b4b
```