[![Latest Stable Version](https://poser.pugx.org/ralfmaxxx/behat_multidimensional_extension/v/stable)](https://packagist.org/packages/ralfmaxxx/behat_multidimensional_extension)[![Total Downloads](https://poser.pugx.org/ralfmaxxx/behat_multidimensional_extension/downloads)](https://packagist.org/packages/ralfmaxxx/behat_multidimensional_extension) [![Latest Unstable Version](https://poser.pugx.org/ralfmaxxx/behat_multidimensional_extension/v/unstable)](https://packagist.org/packages/ralfmaxxx/behat_multidimensional_extension) [![License](https://poser.pugx.org/ralfmaxxx/behat_multidimensional_extension/license)](https://packagist.org/packages/ralfmaxxx/behat_multidimensional_extension)
### Installation
In your *behat.yml* file just add this:
```yml
default:
    extensions:
         TableNode\Extension\NestedTableNodeExtension: ~
```

From now each TableNode object will be replaced by NestedTableNode instance, which adds one additional method: getNestedHash().

### How to use it?

After you install this extension, you can describe your data with dot notation: *model.value.something* like in this example:
```gherkin
Feature: Something

    Scenario:
        When i do something with article:
            | article.name | author.id |
            | test         | 2         |

```
And you can take advantage of that in your step definition:
```php
/**
 * @When i do something with article:
 */
public function iDoSomethingWithArticle(NestedTableNode $table)
{
    $table->getNestedHash();
}
```
Or just you do up to this point:
```php
/**
 * @When i do something with article:
 */
public function iDoSomethingWithArticle(TableNode $table)
{
    /**
    * @var NestedTableNode
    */
    $table->getNestedHash();
}
```
