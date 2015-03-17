Yii2 User Profile
======
Manage configuration from database

Installation
------------

### One
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```sh
php composer.phar require --prefer-dist sersid/yii2-user-profile "dev-master"
```

or add

```
"sersid/yii2-user-profile": "dev-master"
```

to the require section of your `composer.json` file.



### Two

Applying migrations

```
yii migrate --migrationPath=@vendor/sersid/yii2-user-profile/migrations
```



### Three
```php
$config = [
    ...
    'components' => [
        ...
        'profile' => [
            'class' => 'sersid\profile\components\Profile',
        ],
    ]
];
```

Usage
-----

Once the extension is installed, simply use it in your code by  :

#### Set
```php
Yii::$app->profile->set('foo', 'bar');
Yii::$app->profile->set(['foo' => 'bar']);
```

#### Get
```php
Yii::$app->profile->get('foo'); // bar
```

#### Model
```php
Yii::$app->profile->model(); // sersid\profile\models\Model
```

Create fields
-----

### One
Create migration

```
yii migrate/create profile_fields
```

```php
use yii\db\Schema;
use yii\db\Migration;
class m150317_155953_profile_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%profile}}', 'lang', Schema::TYPE_STRING);
        // ... your fields
    }
    public function down()
    {
        $this->dropColumn('{{%profile}}', 'lang');
        // ... your fields
    }
}
```

### Two
Update model

```php
namespace app\models;
use sersid\profile\models\Model;
class Profile extends Model
{
    const LANG_EN = 'en';
    const LANG_RU = 'ru';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['lang', 'default', 'value' => self::LANG_EN],
            ['lang', 'in', 'range' => [self::LANG_EN, self::LANG_RU]],
            // ... your rules
        ];
    }
}
```

### Three
```php
$config = [
    ...
    'components' => [
        ...
        'profile' => [
            'class' => 'sersid\profile\components\Profile',
            'model' => 'app\models\Profile',
        ],
    ]
];
```

Uninstall
------------

Applying migrations

```
yii migrate/down --migrationPath=@vendor/sersid/yii2-user-profile/migrations
```

