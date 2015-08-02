### Installation

In *behat.yml* just add:
```yml
default:
    extensions:
         TableNode\Extension\NestedTableNodeExtension: ~
```

From now each TableNode object will be replaced by NestedTableNode instance, which adds one method: getNestedHash().

### How to use it?

After installation you can describe your data with dot notation: *model.value.something*.
```gherkin
Feature: As

    Scenario:
        When i do something:
            | article.name | author.id |
            | test         | 2         |

```
And you can take advantage of that in your step definition:
```php
/**
 * @When i do something:
 */
public function someStep(NestedTableNode $table)
{
    $table->getNestedHash();
}
```
